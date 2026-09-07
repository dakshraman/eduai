import AppLayout from '@/layouts/AppLayout';
import { Link, useForm, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, Power, Timer, Users, GraduationCap, BookOpen } from 'lucide-react';

const STATUS_STYLES = {
    active: 'bg-emerald-100 text-emerald-700',
    trial: 'bg-blue-100 text-blue-700',
    expired: 'bg-red-100 text-red-700',
    cancelled: 'bg-gray-100 text-gray-600',
};

const ROLE_LABELS = {
    super_admin: 'Superadmin',
    admin: 'Account Admin',
    accountant: 'Accountant',
    teacher: 'Teacher',
    student: 'Student',
    parent: 'Parent',
};

export default function Show({ school, stats, recentUsers }) {
    const { data, setData, post, processing } = useForm({ days: 30 });
    const [confirming, setConfirming] = useState(false);

    const toggleActive = () => {
        setConfirming(true);
    };

    return (
        <AppLayout title={school.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/superadmin/schools">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{school.name}</h1>
                            <p className="text-muted-foreground text-sm">
                                {school.code} · {school.email} {school.phone && `· ${school.phone}`}
                            </p>
                        </div>
                    </div>
                    <div className="flex items-center gap-2">
                        <Badge variant={school.active_status ? 'secondary' : 'outline'}>
                            {school.active_status ? 'Active' : 'Inactive'}
                        </Badge>
                        <Badge className={STATUS_STYLES[school.subscription?.status] || 'bg-gray-100 text-gray-600'}>
                            {school.subscription?.status ?? 'no-subscription'}
                        </Badge>
                        <Button
                            variant="outline"
                            size="sm"
                            className="gap-2"
                            onClick={toggleActive}
                            disabled={confirming}
                        >
                            <Power className="h-4 w-4" />
                            {school.active_status ? 'Deactivate' : 'Activate'}
                        </Button>
                    </div>
                </div>

                {confirming && (
                    <Card className="border-destructive/40">
                        <CardContent className="p-4 flex items-center justify-between gap-4">
                            <p className="text-sm">
                                {school.active_status
                                    ? `Deactivate "${school.name}"? Users won't be able to log in.`
                                    : `Activate "${school.name}"?`}
                            </p>
                            <div className="flex gap-2">
                                <Button variant="ghost" size="sm" onClick={() => setConfirming(false)}>Cancel</Button>
                                <Button
                                    variant={school.active_status ? 'destructive' : 'default'}
                                    size="sm"
                                    onClick={() => {
                                        setConfirming(false);
                                        router.post(`/superadmin/schools/${school.id}/activate`);
                                    }}
                                >
                                    Confirm
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Stats */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <Card><CardContent className="p-6 flex items-center gap-4">
                        <div className="h-12 w-12 rounded-lg bg-secondary/50 flex items-center justify-center"><Users className="h-6 w-6" /></div>
                        <div><p className="text-sm text-muted-foreground">Users</p><p className="text-2xl font-bold">{stats.users}</p></div>
                    </CardContent></Card>
                    <Card><CardContent className="p-6 flex items-center gap-4">
                        <div className="h-12 w-12 rounded-lg bg-primary/50 flex items-center justify-center"><GraduationCap className="h-6 w-6" /></div>
                        <div><p className="text-sm text-muted-foreground">Students</p><p className="text-2xl font-bold">{stats.students}</p></div>
                    </CardContent></Card>
                    <Card><CardContent className="p-6 flex items-center gap-4">
                        <div className="h-12 w-12 rounded-lg bg-accent/50 flex items-center justify-center"><BookOpen className="h-6 w-6" /></div>
                        <div><p className="text-sm text-muted-foreground">Teachers</p><p className="text-2xl font-bold">{stats.teachers}</p></div>
                    </CardContent></Card>
                    <Card><CardContent className="p-6 flex items-center gap-4">
                        <div className="h-12 w-12 rounded-lg bg-secondary/50 flex items-center justify-center"><BookOpen className="h-6 w-6" /></div>
                        <div><p className="text-sm text-muted-foreground">Classes</p><p className="text-2xl font-bold">{stats.classes}</p></div>
                    </CardContent></Card>
                </div>

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Subscription */}
                    <Card>
                        <CardHeader><CardTitle className="text-base">Subscription</CardTitle></CardHeader>
                        <CardContent className="space-y-3 text-sm">
                            <div className="flex justify-between"><span className="text-muted-foreground">Plan</span><span className="font-medium">{school.subscription?.plan?.name ?? '—'}</span></div>
                            <div className="flex justify-between"><span className="text-muted-foreground">Status</span><span className="font-medium capitalize">{school.subscription?.status ?? '—'}</span></div>
                            <div className="flex justify-between"><span className="text-muted-foreground">Billing period</span><span className="font-medium capitalize">{school.subscription?.billing_period ?? '—'}</span></div>
                            <div className="flex justify-between"><span className="text-muted-foreground">Trial ends</span><span className="font-medium">{school.subscription?.trial_ends_at ?? '—'}</span></div>
                            <div className="flex justify-between"><span className="text-muted-foreground">Period end</span><span className="font-medium">{school.subscription?.current_period_end ?? '—'}</span></div>

                            <form
                                onSubmit={(e) => { e.preventDefault(); post(`/superadmin/schools/${school.id}/extend-trial`); }}
                                className="flex items-end gap-2 pt-3 border-t border-border"
                            >
                                <div className="flex-1">
                                    <Label className="mb-1 block text-xs">Extend trial (days)</Label>
                                    <Input type="number" min="1" max="365" value={data.days} onChange={(e) => setData('days', e.target.value)} />
                                </div>
                                <Button type="submit" disabled={processing} variant="outline" className="gap-2">
                                    <Timer className="h-4 w-4" /> Extend
                                </Button>
                            </form>
                        </CardContent>
                    </Card>

                    {/* Recent users */}
                    <Card>
                        <CardHeader><CardTitle className="text-base">Recent Users</CardTitle></CardHeader>
                        <CardContent className="p-0">
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Role</TableHead>
                                        <TableHead>Status</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {recentUsers?.length > 0 ? recentUsers.map((user) => (
                                        <TableRow key={user.id}>
                                            <TableCell>
                                                <div>
                                                    <p className="font-medium text-sm">{user.name}</p>
                                                    <p className="text-xs text-muted-foreground">{user.email}</p>
                                                </div>
                                            </TableCell>
                                            <TableCell className="text-sm">{ROLE_LABELS[user.role] || user.role}</TableCell>
                                            <TableCell>
                                                <Badge variant={user.active_status ? 'secondary' : 'outline'}>
                                                    {user.active_status ? 'Active' : 'Inactive'}
                                                </Badge>
                                            </TableCell>
                                        </TableRow>
                                    )) : (
                                        <TableRow><TableCell colSpan={3} className="text-center py-6 text-muted-foreground">No users yet.</TableCell></TableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}