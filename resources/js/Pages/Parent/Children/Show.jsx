import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { ArrowLeft, GraduationCap, ClipboardCheck, FileText, DollarSign } from 'lucide-react';

export default function Show({ student, summary, payments, results }) {
    return (
        <AppLayout title={student.user?.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/parent">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{student.user?.name}</h1>
                            <p className="text-muted-foreground">
                                {student.class?.name}{student.section?.name ? ` · Section ${student.section.name}` : ''}
                                {student.admission_number ? ` · Adm. ${student.admission_number}` : ''}
                            </p>
                        </div>
                    </div>
                    <Badge variant="secondary">Attendance: {summary.attendancePercentage}%</Badge>
                </div>

                {/* Quick nav */}
                <div className="flex flex-wrap gap-2">
                    <Button variant="outline" size="sm" asChild>
                        <Link href={`/parent/children/${student.id}/attendance`}>
                            <ClipboardCheck className="h-4 w-4 mr-1" /> Attendance
                        </Link>
                    </Button>
                    <Button variant="outline" size="sm" asChild>
                        <Link href={`/parent/children/${student.id}/results`}>
                            <FileText className="h-4 w-4 mr-1" /> Results
                        </Link>
                    </Button>
                    <Button variant="outline" size="sm" asChild>
                        <Link href={`/parent/children/${student.id}/fees`}>
                            <DollarSign className="h-4 w-4 mr-1" /> Fees
                        </Link>
                    </Button>
                </div>

                {/* Attendance summary */}
                <div className="grid gap-4 md:grid-cols-4">
                    <Card><CardContent className="p-5"><p className="text-sm text-muted-foreground">Days Present</p><p className="text-2xl font-bold">{summary.present}</p></CardContent></Card>
                    <Card><CardContent className="p-5"><p className="text-sm text-muted-foreground">Days Absent</p><p className="text-2xl font-bold">{summary.absent}</p></CardContent></Card>
                    <Card><CardContent className="p-5"><p className="text-sm text-muted-foreground">Late</p><p className="text-2xl font-bold">{summary.late}</p></CardContent></Card>
                    <Card><CardContent className="p-5"><p className="text-sm text-muted-foreground">Total Days</p><p className="text-2xl font-bold">{summary.totalDays}</p></CardContent></Card>
                </div>

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Recent results */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><FileText className="h-4 w-4" /> Recent Results</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {results?.length > 0 ? results.map((r) => (
                                    <div key={r.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{r.exam?.name}</p>
                                            <p className="text-xs text-muted-foreground">{r.subject?.name}</p>
                                        </div>
                                        <Badge variant="secondary">{r.marks_obtained} marks</Badge>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No results yet.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Recent payments */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><DollarSign className="h-4 w-4" /> Recent Payments</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {payments?.length > 0 ? payments.map((p) => (
                                    <div key={p.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{p.feeStructure?.feeCategory?.name ?? 'Fee'}</p>
                                            <p className="text-xs text-muted-foreground">{p.payment_date}</p>
                                        </div>
                                        <Badge className="bg-emerald-100 text-emerald-700">${p.amount_paid}</Badge>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No payments yet.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}