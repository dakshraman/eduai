import AppLayout from '@/layouts/AppLayout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { FileText } from 'lucide-react';

export default function Index({ grouped, overall }) {
    return (
        <AppLayout title="My Results">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">My Results</h1>
                    <p className="text-muted-foreground">Your exam performance</p>
                </div>

                {/* Overall summary */}
                {overall?.fullMark > 0 && (
                    <Card className="border-primary/30">
                        <CardContent className="p-6 flex items-center gap-4">
                            <div className="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                <FileText className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Overall Performance</p>
                                <p className="text-3xl font-extrabold">
                                    {overall.percentage}% <span className="text-base font-medium text-muted-foreground">({overall.total} / {overall.fullMark} marks)</span>
                                </p>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Per-exam results */}
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
                            <p className="text-sm text-muted-foreground mt-1">Results will appear here once teachers enter them.</p>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}