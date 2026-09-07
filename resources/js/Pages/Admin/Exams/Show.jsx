import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Pencil, ArrowLeft, BarChart3 } from 'lucide-react';

const TYPE_LABELS = {
    unit: 'Unit Test',
    midterm: 'Midterm',
    final: 'Final',
    assignment: 'Assignment',
};

const TYPE_VARIANTS = {
    unit: 'secondary',
    midterm: 'default',
    final: 'destructive',
    assignment: 'outline',
};

export default function Show({ exam, subjects }) {
    const formatDate = (d) => d ? new Date(d).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '-';

    return (
        <AppLayout title={exam.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/exams">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{exam.name}</h1>
                            <p className="text-muted-foreground">Exam details and results</p>
                        </div>
                    </div>
                    <div className="flex gap-2">
                        <Link href={`/exams/${exam.id}/results`}>
                            <Button variant="outline" className="gap-2"><BarChart3 className="h-4 w-4" /> Enter Results</Button>
                        </Link>
                        <Link href={`/exams/${exam.id}/edit`}>
                            <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                        </Link>
                    </div>
                </div>

                <div className="grid gap-4 md:grid-cols-4">
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Class</p>
                            <p className="text-lg font-semibold">{exam.class?.name || '-'}</p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Type</p>
                            <Badge variant={TYPE_VARIANTS[exam.exam_type] || 'secondary'}>
                                {TYPE_LABELS[exam.exam_type] || exam.exam_type}
                            </Badge>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Start Date</p>
                            <p className="text-lg font-semibold">{formatDate(exam.start_date)}</p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">End Date</p>
                            <p className="text-lg font-semibold">{formatDate(exam.end_date)}</p>
                        </CardContent>
                    </Card>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle className="text-base">Results</CardTitle>
                    </CardHeader>
                    <CardContent>
                        {exam.exam_results?.length > 0 ? (
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Student</TableHead>
                                        <TableHead>Subject</TableHead>
                                        <TableHead>Marks</TableHead>
                                        <TableHead>Remarks</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {exam.exam_results.map((result) => (
                                        <TableRow key={result.id}>
                                            <TableCell className="font-medium">{result.student?.user?.name || '-'}</TableCell>
                                            <TableCell>{result.subject?.name || '-'}</TableCell>
                                            <TableCell>{result.marks_obtained}/{result.subject?.full_mark || '-'}</TableCell>
                                            <TableCell>{result.remarks || '-'}</TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        ) : (
                            <div className="text-center py-4 text-muted-foreground">
                                <p>No results recorded yet.</p>
                                <Link href={`/exams/${exam.id}/results`}>
                                    <Button variant="outline" className="mt-2">Enter Results</Button>
                                </Link>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
