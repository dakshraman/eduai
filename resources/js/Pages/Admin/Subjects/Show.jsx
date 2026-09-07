import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Pencil, ArrowLeft } from 'lucide-react';

export default function Show({ subject }) {
    return (
        <AppLayout title={subject.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/subjects">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{subject.name}</h1>
                            <p className="text-muted-foreground">Subject details and exam results</p>
                        </div>
                    </div>
                    <Link href={`/subjects/${subject.id}/edit`}>
                        <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-4">
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Class</p>
                            <p className="text-lg font-semibold">{subject.class?.name || '-'}</p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Subject Code</p>
                            <p className="text-lg font-semibold">{subject.subject_code || '-'}</p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Pass / Full Mark</p>
                            <p className="text-lg font-semibold">{subject.pass_mark} / {subject.full_mark}</p>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="pt-6">
                            <p className="text-sm text-muted-foreground">Status</p>
                            <Badge variant={subject.active_status ? 'default' : 'secondary'}>
                                {subject.active_status ? 'Active' : 'Inactive'}
                            </Badge>
                        </CardContent>
                    </Card>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle className="text-base">Exam Results</CardTitle>
                    </CardHeader>
                    <CardContent>
                        {subject.exam_results?.length > 0 ? (
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Student</TableHead>
                                        <TableHead>Exam</TableHead>
                                        <TableHead>Marks</TableHead>
                                        <TableHead>Grade</TableHead>
                                        <TableHead>Result</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {subject.exam_results.map((result) => (
                                        <TableRow key={result.id}>
                                            <TableCell className="font-medium">{result.student?.user?.name || '-'}</TableCell>
                                            <TableCell>{result.exam?.name || '-'}</TableCell>
                                            <TableCell>{result.marks_obtained}/{result.exam?.total_marks || '-'}</TableCell>
                                            <TableCell>{result.grade || '-'}</TableCell>
                                            <TableCell>
                                                <Badge variant={result.marks_obtained >= (subject.pass_mark) ? 'default' : 'destructive'}>
                                                    {result.marks_obtained >= (subject.pass_mark) ? 'Pass' : 'Fail'}
                                                </Badge>
                                            </TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        ) : (
                            <p className="text-center py-4 text-muted-foreground">No exam results yet.</p>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
