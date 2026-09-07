import AppLayout from '@/layouts/AppLayout';
import { Link, useForm, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Search, Eye } from 'lucide-react';

const STATUS_STYLES = {
    active: 'bg-emerald-100 text-emerald-700',
    trial: 'bg-blue-100 text-blue-700',
    expired: 'bg-red-100 text-red-700',
    cancelled: 'bg-gray-100 text-gray-600',
};

export default function Index({ schools, filters }) {
    const { data, setData, get } = useForm({ search: filters?.search || '' });
    const [searching, setSearching] = useState(false);

    const search = (e) => {
        e.preventDefault();
        setSearching(true);
        get('/superadmin/schools', { preserveState: true, onFinish: () => setSearching(false) });
    };

    return (
        <AppLayout title="Schools">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Schools</h1>
                        <p className="text-muted-foreground">Manage all schools on the platform</p>
                    </div>
                </div>

                <Card>
                    <CardContent className="p-4">
                        <form onSubmit={search} className="flex items-end gap-4">
                            <div className="flex-1">
                                <Input
                                    value={data.search}
                                    onChange={(e) => setData('search', e.target.value)}
                                    placeholder="Search by name, code, or email..."
                                />
                            </div>
                            <Button type="submit" disabled={searching} className="gap-2">
                                <Search className="h-4 w-4" /> Search
                            </Button>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>School</TableHead>
                                    <TableHead>Code</TableHead>
                                    <TableHead>Users</TableHead>
                                    <TableHead>Plan</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {schools?.data?.length > 0 ? schools.data.map((school) => (
                                    <TableRow key={school.id}>
                                        <TableCell>
                                            <div>
                                                <p className="font-medium">{school.name}</p>
                                                <p className="text-xs text-muted-foreground">{school.email}</p>
                                            </div>
                                        </TableCell>
                                        <TableCell className="font-mono text-sm">{school.code}</TableCell>
                                        <TableCell>{school.users_count}</TableCell>
                                        <TableCell>{school.subscription?.plan?.name ?? '-'}</TableCell>
                                        <TableCell>
                                            <Badge className={STATUS_STYLES[school.subscription?.status] || 'bg-gray-100 text-gray-600'}>
                                                {school.subscription?.status ?? 'no-subscription'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <Button variant="ghost" size="sm" asChild>
                                                <Link href={`/superadmin/schools/${school.id}`} className="gap-1">
                                                    <Eye className="h-4 w-4" /> View
                                                </Link>
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={6} className="text-center py-8 text-muted-foreground">
                                            No schools found.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                {schools?.links && (
                    <div className="flex items-center justify-between text-sm text-muted-foreground">
                        <span>Showing {schools.from ?? 0}–{schools.to ?? 0} of {schools.total}</span>
                        <div className="flex gap-2">
                            {schools.links.map((link, i) => (
                                <Button
                                    key={i}
                                    variant={link.active ? 'default' : 'ghost'}
                                    size="sm"
                                    disabled={!link.url}
                                    onClick={() => link.url && router.get(link.url)}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}