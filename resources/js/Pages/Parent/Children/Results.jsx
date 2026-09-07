import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, FileText } from 'lucide-react';

export default function Results({ student, grouped }) {
    return (
        <AppLayout title={`${student.user?.name} - Results`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href={`/parent/children/${student.id}`}>
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Results — {student.user?.name}</h1>
                        <p className="text-muted-foreground">Exam performance by subject</p>
                    </div>
                </div>

                {grouped?.length > 0 ? grouped.map((group) => (
                    <Card key={group.exam.id}>
                        <CardHeader className="flex flex-row items-center justify-between">
                            <CardTitle className="text-base">
                                {group.exam.name}
                                <span className="ml-2 text-xs text-muted-foreground font-normal">{group.exam.exam_type}</span>
                            </CardTitle>
                            <Badge variant="secondary">{group.percentage}%</Badge>
                        </CardHeader>
                        <CardContent className="p-0">
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Subject</TableHead>
                                        <TableHead className="text-center">Marks Obtained</TableHead>
                                        <TableHead className="text-center">Full Marks</TableHead>
                                        <TableHead>Remarks</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {group.results.map((r) => (
                                        <TableRow key={r.id}>
                                            <TableCell className="font-medium">{r.subject?.name}</TableCell>
                                            <TableCell className="text-center">{r.marks_obtained}</TableCell>
                                            <TableCell className="text-center">{r.subject?.full_mark ?? '—'}</TableCell>
                                            <TableCell className="text-muted-foreground">{r.remarks || '-'}</TableCell>
                                        </TableRow>
                                    ))}
                                    <TableRow className="bg-muted/30">
                                        <TableCell className="font-semibold">Total</TableCell>
                                        <TableCell className="text-center font-semibold">{group.total}</TableCell>
                                        <TableCell className="text-center font-semibold">{group.fullMark}</TableCell>
                                        <TableCell />
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                )) : (
                    <Card>
                        <CardContent className="py-12 text-center">
                            <FileText className="h-10 w-10 text-muted-foreground mx-auto mb-4" />
                            <p className="font-medium">No results published yet.</p>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}