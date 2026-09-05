import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Plus, Search, Eye, Pencil, Trash2 } from 'lucide-react';

export default function Index({ teachers, filters }) {
    const [search, setSearch] = useState(filters?.search || '');

    const handleSearch = () => {
        router.get('/teachers', { search }, { preserveState: true });
    };

    return (
        <AppLayout title="Teachers">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Teachers</h1>
                        <p className="text-muted-foreground">Manage teacher records</p>
                    </div>
                    <Link href="/teachers/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Teacher</Button>
                    </Link>
                </div>

                {/* Filters */}
                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-end gap-4">
                            <div className="flex-1">
                                <Input placeholder="Search teachers..." value={search} onChange={(e) => setSearch(e.target.value)} onKeyDown={(e) => e.key === 'Enter' && handleSearch()} />
                            </div>
                            <Button variant="secondary" onClick={handleSearch}><Search className="h-4 w-4" /></Button>
                        </div>
                    </CardContent>
                </Card>

                {/* Table */}
                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Employee ID</TableHead>
                                    <TableHead>Designation</TableHead>
                                    <TableHead>Phone</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {teachers?.data?.length > 0 ? teachers.data.map((teacher) => (
                                    <TableRow key={teacher.id}>
                                        <TableCell className="font-medium">{teacher.user?.name}</TableCell>
                                        <TableCell>{teacher.employee_id}</TableCell>
                                        <TableCell>{teacher.designation || '-'}</TableCell>
                                        <TableCell>{teacher.user?.phone || '-'}</TableCell>
                                        <TableCell>
                                            <Badge variant={teacher.active_status ? 'default' : 'secondary'}>
                                                {teacher.active_status ? 'Active' : 'Inactive'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex items-center justify-end gap-1">
                                                <Link href={`/teachers/${teacher.id}`}>
                                                    <Button variant="ghost" size="icon"><Eye className="h-4 w-4" /></Button>
                                                </Link>
                                                <Link href={`/teachers/${teacher.id}/edit`}>
                                                    <Button variant="ghost" size="icon"><Pencil className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" className="text-destructive" onClick={() => {
                                                    if (confirm('Delete this teacher?')) router.delete(`/teachers/${teacher.id}`);
                                                }}><Trash2 className="h-4 w-4" /></Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow><TableCell colSpan={6} className="text-center py-8 text-muted-foreground">No teachers found.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
