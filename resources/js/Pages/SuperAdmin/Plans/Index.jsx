import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Plus, Pencil, Trash2, Power } from 'lucide-react';

export default function Index({ plans }) {
    const toggle = (plan) => {
        router.post(`/superadmin/plans/${plan.id}/toggle`);
    };

    const destroy = (plan) => {
        if (confirm(`Delete "${plan.name}"? This cannot be undone.`)) {
            router.delete(`/superadmin/plans/${plan.id}`);
        }
    };

    return (
        <AppLayout title="Subscription Plans">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Subscription Plans</h1>
                        <p className="text-muted-foreground">Manage the plans schools can subscribe to</p>
                    </div>
                    <Link href="/superadmin/plans/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Plan</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-3">
                    {plans?.map((plan) => (
                        <Card key={plan.id} className={!plan.active_status ? 'opacity-70' : ''}>
                            <CardContent className="p-6">
                                <div className="flex items-start justify-between mb-4">
                                    <div>
                                        <p className="font-semibold text-lg">{plan.name}</p>
                                        <p className="text-xs text-muted-foreground">{plan.subscriptions_count} subscribers</p>
                                    </div>
                                    <Badge variant={plan.active_status ? 'secondary' : 'outline'}>
                                        {plan.active_status ? 'Active' : 'Inactive'}
                                    </Badge>
                                </div>
                                <div className="flex items-baseline gap-1 mb-4">
                                    <span className="text-3xl font-extrabold">${plan.price_monthly}</span>
                                    <span className="text-sm text-muted-foreground">/month</span>
                                    {plan.price_yearly && (
                                        <span className="ml-2 text-xs text-muted-foreground">or ${plan.price_yearly}/yr</span>
                                    )}
                                </div>
                                {plan.features?.length > 0 && (
                                    <ul className="text-sm text-muted-foreground space-y-1 mb-4">
                                        {plan.features.slice(0, 4).map((f, i) => (
                                            <li key={i} className="flex items-center gap-2">
                                                <span className="h-1 w-1 rounded-full bg-primary" /> {f}
                                            </li>
                                        ))}
                                        {plan.features.length > 4 && <li>+{plan.features.length - 4} more</li>}
                                    </ul>
                                )}
                                <div className="flex gap-2">
                                    <Button variant="outline" size="sm" className="flex-1 gap-1" onClick={() => toggle(plan)}>
                                        <Power className="h-3 w-3" />
                                        {plan.active_status ? 'Deactivate' : 'Activate'}
                                    </Button>
                                    <Link href={`/superadmin/plans/${plan.id}/edit`}>
                                        <Button variant="ghost" size="icon" className="h-8 w-8"><Pencil className="h-3 w-3" /></Button>
                                    </Link>
                                    <Button variant="ghost" size="icon" className="h-8 w-8 text-destructive" onClick={() => destroy(plan)}>
                                        <Trash2 className="h-3 w-3" />
                                    </Button>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Plan</TableHead>
                                    <TableHead>Monthly</TableHead>
                                    <TableHead>Yearly</TableHead>
                                    <TableHead>Subscribers</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {plans?.map((plan) => (
                                    <TableRow key={plan.id}>
                                        <TableCell className="font-medium">{plan.name}</TableCell>
                                        <TableCell>${plan.price_monthly}</TableCell>
                                        <TableCell>${plan.price_yearly || '-'}</TableCell>
                                        <TableCell>{plan.subscriptions_count}</TableCell>
                                        <TableCell>
                                            <Badge variant={plan.active_status ? 'secondary' : 'outline'}>
                                                {plan.active_status ? 'Active' : 'Inactive'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex items-center justify-end gap-1">
                                                <Link href={`/superadmin/plans/${plan.id}/edit`}>
                                                    <Button variant="ghost" size="icon"><Pencil className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" className="text-destructive" onClick={() => destroy(plan)}>
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
