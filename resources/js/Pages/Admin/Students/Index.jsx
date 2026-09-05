import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Plus, Search, Eye, Pencil, Trash2 } from 'lucide-react';

export default function Index({ students, classes, filters }) {
    const [search, setSearch] = useState(filters?.search || '');
    const [classId, setClassId] = useState(filters?.class_id || '');

    const handleSearch = () => {
        router.get('/students', { search, class_id: classId }, { preserveState: true });
    };

    return (
        <AppLayout title="Students">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Students</h1>
                        <p className="text-muted-foreground">Manage student records</p>
                    </div>
                    <Link href="/students/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Student</Button>
                    </Link>
                </div>

                {/* Filters */}
                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-end gap-4">
                            <div className="flex-1">
                                <Input placeholder="Search students..." value={search} onChange={(e) => setSearch(e.target.value)} onKeyDown={(e) => e.key === 'Enter' && handleSearch()} />
                            </div>
                            <Select value={classId} onValueChange={setClassId}>
                                <SelectTrigger className="w-[180px]"><SelectValue placeholder="All Classes" /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="all">All Classes</SelectItem>
                                    {classes?.map((c) => <SelectItem key={c.id} value={String(c.id)}>{c.name}</SelectItem>)}
                                </SelectContent>
                            </Select>
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
                                    <TableHead>Admission #</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Section</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {students?.data?.length > 0 ? students.data.map((student) => (
                                    <TableRow key={student.id}>
                                        <TableCell className="font-medium">{student.user?.name}</TableCell>
                                        <TableCell>{student.admission_number}</TableCell>
                                        <TableCell>{student.class?.name}</TableCell>
                                        <TableCell>{student.section?.name || '-'}</TableCell>
                                        <TableCell>
                                            <Badge variant={student.active_status ? 'default' : 'secondary'}>
                                                {student.active_status ? 'Active' : 'Inactive'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex items-center justify-end gap-1">
                                                <Link href={`/students/${student.id}`}>
                                                    <Button variant="ghost" size="icon"><Eye className="h-4 w-4" /></Button>
                                                </Link>
                                                <Link href={`/students/${student.id}/edit`}>
                                                    <Button variant="ghost" size="icon"><Pencil className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" className="text-destructive" onClick={() => {
                                                    if (confirm('Delete this student?')) router.delete(`/students/${student.id}`);
                                                }}><Trash2 className="h-4 w-4" /></Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow><TableCell colSpan={6} className="text-center py-8 text-muted-foreground">No students found.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
