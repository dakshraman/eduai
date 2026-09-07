import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { FileText } from 'lucide-react';

export default function Index({ exams }) {
    return (
        <AppLayout title="Exams">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Exams</h1>
                    <p className="text-muted-foreground">Select an exam to enter or update results</p>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Exam</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Type</TableHead>
                                    <TableHead>Start</TableHead>
                                    <TableHead>End</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {exams?.data?.length > 0 ? exams.data.map((exam) => (
                                    <TableRow key={exam.id}>
                                        <TableCell className="font-medium">{exam.name}</TableCell>
                                        <TableCell>{exam.class?.name}</TableCell>
                                        <TableCell><Badge variant="secondary">{exam.exam_type}</Badge></TableCell>
                                        <TableCell>{exam.start_date}</TableCell>
                                        <TableCell>{exam.end_date}</TableCell>
                                        <TableCell className="text-right">
                                            <Button variant="outline" size="sm" asChild className="gap-2">
                                                <Link href={`/teacher/exams/${exam.id}/results`}>
                                                    <FileText className="h-4 w-4" /> Enter Results
                                                </Link>
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={6} className="text-center py-8 text-muted-foreground">
                                            No exams found.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                {exams?.links && (
                    <div className="flex items-center justify-between text-sm text-muted-foreground">
                        <span>Showing {exams.from ?? 0}–{exams.to ?? 0} of {exams.total}</span>
                        <div className="flex gap-2">
                            {exams.links.map((link, i) => (
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