import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Plus, Search, Eye, Pencil, Trash2 } from 'lucide-react';

export default function Index({ subjects, classes }) {
    const [search, setSearch] = useState('');
    const [classFilter, setClassFilter] = useState('all');

    const handleFilter = () => {
        const params = {};
        if (classFilter && classFilter !== 'all') params.class_id = classFilter;
        router.get('/subjects', params, { preserveState: true });
    };

    return (
        <AppLayout title="Subjects">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Subjects</h1>
                        <p className="text-muted-foreground">Manage school subjects</p>
                    </div>
                    <Link href="/subjects/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Subject</Button>
                    </Link>
                </div>

                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-end gap-4">
                            <div className="flex-1">
                                <Select value={classFilter} onValueChange={(v) => { setClassFilter(v); }}>
                                    <SelectTrigger><SelectValue placeholder="All Classes" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">All Classes</SelectItem>
                                        {classes?.map((cls) => (
                                            <SelectItem key={cls.id} value={String(cls.id)}>{cls.name}</SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                            </div>
                            <Button variant="secondary" onClick={handleFilter}><Search className="h-4 w-4" /></Button>
                        </div>
                    </CardContent>
                </Card>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Code</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Pass Mark</TableHead>
                                    <TableHead>Full Mark</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {subjects?.data?.length > 0 ? subjects.data.map((subject) => (
                                    <TableRow key={subject.id}>
                                        <TableCell className="font-medium">{subject.name}</TableCell>
                                        <TableCell>{subject.subject_code || '-'}</TableCell>
                                        <TableCell>{subject.class?.name || '-'}</TableCell>
                                        <TableCell>{subject.pass_mark}</TableCell>
                                        <TableCell>{subject.full_mark}</TableCell>
                                        <TableCell>
                                            <Badge variant={subject.active_status ? 'default' : 'secondary'}>
                                                {subject.active_status ? 'Active' : 'Inactive'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex items-center justify-end gap-1">
                                                <Link href={`/subjects/${subject.id}`}>
                                                    <Button variant="ghost" size="icon"><Eye className="h-4 w-4" /></Button>
                                                </Link>
                                                <Link href={`/subjects/${subject.id}/edit`}>
                                                    <Button variant="ghost" size="icon"><Pencil className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" className="text-destructive" onClick={() => {
                                                    if (confirm('Delete this subject?')) router.delete(`/subjects/${subject.id}`);
                                                }}><Trash2 className="h-4 w-4" /></Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow><TableCell colSpan={7} className="text-center py-8 text-muted-foreground">No subjects found.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
