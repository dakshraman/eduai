import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Plus, Eye, Pencil, Trash2, BarChart3 } from 'lucide-react';

const TYPE_VARIANTS = {
    unit: 'secondary',
    midterm: 'default',
    final: 'destructive',
    assignment: 'outline',
};

const TYPE_LABELS = {
    unit: 'Unit Test',
    midterm: 'Midterm',
    final: 'Final',
    assignment: 'Assignment',
};

export default function Index({ exams }) {
    const formatDate = (d) => d ? new Date(d).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '-';

    return (
        <AppLayout title="Exams">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Exams</h1>
                        <p className="text-muted-foreground">Manage examinations</p>
                    </div>
                    <Link href="/exams/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Exam</Button>
                    </Link>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Start Date</TableHead>
                                    <TableHead>End Date</TableHead>
                                    <TableHead>Type</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {exams?.data?.length > 0 ? exams.data.map((exam) => (
                                    <TableRow key={exam.id}>
                                        <TableCell className="font-medium">{exam.name}</TableCell>
                                        <TableCell>{exam.class?.name}</TableCell>
                                        <TableCell>{formatDate(exam.start_date)}</TableCell>
                                        <TableCell>{formatDate(exam.end_date)}</TableCell>
                                        <TableCell>
                                            <Badge variant={TYPE_VARIANTS[exam.type] || 'secondary'}>
                                                {TYPE_LABELS[exam.type] || exam.type}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex items-center justify-end gap-1">
                                                <Link href={`/exams/${exam.id}/results`}>
                                                    <Button variant="ghost" size="icon"><BarChart3 className="h-4 w-4" /></Button>
                                                </Link>
                                                <Link href={`/exams/${exam.id}/edit`}>
                                                    <Button variant="ghost" size="icon"><Pencil className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" className="text-destructive" onClick={() => {
                                                    if (confirm('Delete this exam?')) router.delete(`/exams/${exam.id}`);
                                                }}><Trash2 className="h-4 w-4" /></Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow><TableCell colSpan={6} className="text-center py-8 text-muted-foreground">No exams found.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
