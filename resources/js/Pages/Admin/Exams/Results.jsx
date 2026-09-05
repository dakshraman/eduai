import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, Save } from 'lucide-react';

export default function Results({ exam, students, subjects, results }) {
    const { data, setData, post, processing } = useForm({
        results: results || {},
    });

    const setMark = (studentId, subjectId, value) => {
        setData('results', {
            ...data.results,
            [`${studentId}_${subjectId}`]: value,
        });
    };

    const submit = (e) => {
        e.preventDefault();
        post(`/exams/${exam.id}/results`);
    };

    return (
        <AppLayout title={`Results - ${exam.name}`}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/exams">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{exam.name}</h1>
                            <p className="text-muted-foreground">{exam.class?.name} | {exam.type}</p>
                        </div>
                    </div>
                    <form onSubmit={submit}>
                        <Button type="submit" disabled={processing} className="gap-2">
                            <Save className="h-4 w-4" /> Save Results
                        </Button>
                    </form>
                </div>

                {/* Exam Info */}
                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-center gap-6 text-sm">
                            <div><span className="text-muted-foreground">Start:</span> <span className="font-medium">{exam.start_date}</span></div>
                            <div><span className="text-muted-foreground">End:</span> <span className="font-medium">{exam.end_date}</span></div>
                            <div><span className="text-muted-foreground">Total Students:</span> <span className="font-medium">{students?.length ?? 0}</span></div>
                        </div>
                    </CardContent>
                </Card>

                {/* Results Table */}
                <Card>
                    <CardHeader>
                        <CardTitle className="text-base">Enter Marks</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit}>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Student</TableHead>
                                        {subjects?.map((sub) => (
                                            <TableHead key={sub.id} className="text-center">{sub.name}</TableHead>
                                        ))}
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {students?.length > 0 ? students.map((student) => (
                                        <TableRow key={student.id}>
                                            <TableCell className="font-medium">{student.user?.name}</TableCell>
                                            {subjects?.map((sub) => (
                                                <TableCell key={sub.id} className="text-center">
                                                    <Input
                                                        type="number"
                                                        min="0"
                                                        max={sub.full_mark || 100}
                                                        className="w-20 mx-auto text-center"
                                                        value={data.results[`${student.id}_${sub.id}`] || ''}
                                                        onChange={(e) => setMark(student.id, sub.id, e.target.value)}
                                                    />
                                                </TableCell>
                                            ))}
                                        </TableRow>
                                    )) : (
                                        <TableRow>
                                            <TableCell colSpan={(subjects?.length || 0) + 1} className="text-center py-8 text-muted-foreground">
                                                No students enrolled in this class.
                                            </TableCell>
                                        </TableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
