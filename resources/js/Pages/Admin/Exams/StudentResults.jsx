import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, TrendingUp, Award, BarChart3 } from 'lucide-react';

export default function StudentResults({ student, results, stats }) {
    const pct = stats?.percentage ?? 0;
    const grade = pct >= 90 ? 'A+' : pct >= 80 ? 'A' : pct >= 70 ? 'B+' : pct >= 60 ? 'B' : pct >= 50 ? 'C' : 'F';

    return (
        <AppLayout title={`Results - ${student?.user?.name}`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/exams">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">{student?.user?.name}</h1>
                        <p className="text-muted-foreground">Exam results</p>
                    </div>
                </div>

                {/* Student Info Card */}
                <Card>
                    <CardContent className="p-6">
                        <div className="flex items-center gap-6">
                            <div className="flex-1">
                                <p className="text-sm text-muted-foreground">Student</p>
                                <p className="text-lg font-bold">{student?.user?.name}</p>
                            </div>
                            <div className="flex-1">
                                <p className="text-sm text-muted-foreground">Class</p>
                                <p className="text-lg font-bold">{student?.class?.name} - {student?.section?.name}</p>
                            </div>
                            <div className="flex-1">
                                <p className="text-sm text-muted-foreground">Admission #</p>
                                <p className="text-lg font-bold">{student?.admission_number}</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Overall Stats */}
                <div className="grid gap-4 md:grid-cols-3">
                    <Card>
                        <CardContent className="p-6">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm text-muted-foreground">Total Marks</p>
                                    <p className="text-2xl font-bold">{stats?.total_marks ?? 0} / {stats?.full_marks ?? 0}</p>
                                </div>
                                <div className="h-12 w-12 rounded-lg bg-primary/50 flex items-center justify-center">
                                    <BarChart3 className="h-6 w-6" />
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="p-6">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm text-muted-foreground">Percentage</p>
                                    <p className="text-2xl font-bold">{pct.toFixed(1)}%</p>
                                </div>
                                <div className="h-12 w-12 rounded-lg bg-emerald-500/50 flex items-center justify-center">
                                    <TrendingUp className="h-6 w-6" />
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="p-6">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm text-muted-foreground">Grade</p>
                                    <p className="text-2xl font-bold">{grade}</p>
                                </div>
                                <div className="h-12 w-12 rounded-lg bg-amber-500/50 flex items-center justify-center">
                                    <Award className="h-6 w-6" />
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Results Table */}
                <Card>
                    <CardHeader>
                        <CardTitle className="text-base">Detailed Results</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Exam</TableHead>
                                    <TableHead>Subject</TableHead>
                                    <TableHead className="text-center">Marks</TableHead>
                                    <TableHead className="text-center">Full Mark</TableHead>
                                    <TableHead className="text-center">Percentage</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {results?.length > 0 ? results.map((r, i) => {
                                    const p = r.full_mark > 0 ? ((r.marks / r.full_mark) * 100) : 0;
                                    return (
                                        <TableRow key={i}>
                                            <TableCell className="font-medium">{r.exam_name}</TableCell>
                                            <TableCell>{r.subject_name}</TableCell>
                                            <TableCell className="text-center">{r.marks}</TableCell>
                                            <TableCell className="text-center">{r.full_mark}</TableCell>
                                            <TableCell>
                                                <div className="flex items-center justify-center gap-2">
                                                    <Badge variant={p >= 75 ? 'default' : p >= 50 ? 'secondary' : 'destructive'}>
                                                        {p.toFixed(0)}%
                                                    </Badge>
                                                </div>
                                            </TableCell>
                                        </TableRow>
                                    );
                                }) : (
                                    <TableRow>
                                        <TableCell colSpan={5} className="text-center py-8 text-muted-foreground">
                                            No results available yet.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
