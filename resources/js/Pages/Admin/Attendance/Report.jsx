import AppLayout from '@/layouts/AppLayout';
import { router } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Progress } from '@/components/ui/progress';
import { Search, Users, CheckCircle, XCircle, Clock } from 'lucide-react';

export default function Report({ classes, summary, report, filters }) {
    const [classId, setClassId] = useState(filters?.class_id || '');
    const [startDate, setStartDate] = useState(filters?.start_date || '');
    const [endDate, setEndDate] = useState(filters?.end_date || '');

    const handleSearch = () => {
        router.get('/attendance/report', { class_id: classId, start_date: startDate, end_date: endDate }, { preserveState: true });
    };

    const summaryCards = [
        { title: 'Total Students', value: summary?.total ?? 0, icon: Users, color: 'bg-primary/50' },
        { title: 'Present', value: summary?.present ?? 0, icon: CheckCircle, color: 'bg-emerald-500/50' },
        { title: 'Absent', value: summary?.absent ?? 0, icon: XCircle, color: 'bg-red-500/50' },
        { title: 'Late', value: summary?.late ?? 0, icon: Clock, color: 'bg-amber-500/50' },
    ];

    const totalRecords = (summary?.present ?? 0) + (summary?.absent ?? 0) + (summary?.late ?? 0);

    return (
        <AppLayout title="Attendance Report">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Attendance Report</h1>
                    <p className="text-muted-foreground">View attendance statistics and reports</p>
                </div>

                {/* Filter Form */}
                <Card>
                    <CardContent className="p-4">
                        <div className="flex items-end gap-4">
                            <div className="flex-1">
                                <Label className="mb-1 block text-sm">Class</Label>
                                <Select value={classId} onValueChange={setClassId}>
                                    <SelectTrigger><SelectValue placeholder="All Classes" /></SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">All Classes</SelectItem>
                                        {classes?.map((c) => <SelectItem key={c.id} value={String(c.id)}>{c.name}</SelectItem>)}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="flex-1">
                                <Label className="mb-1 block text-sm">Start Date</Label>
                                <Input type="date" value={startDate} onChange={(e) => setStartDate(e.target.value)} />
                            </div>
                            <div className="flex-1">
                                <Label className="mb-1 block text-sm">End Date</Label>
                                <Input type="date" value={endDate} onChange={(e) => setEndDate(e.target.value)} />
                            </div>
                            <Button onClick={handleSearch} className="gap-2"><Search className="h-4 w-4" /> Search</Button>
                        </div>
                    </CardContent>
                </Card>

                {/* Summary Cards */}
                <div className="grid gap-4 md:grid-cols-4">
                    {summaryCards.map((stat, i) => (
                        <Card key={i}>
                            <CardContent className="p-6">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm text-muted-foreground">{stat.title}</p>
                                        <p className="text-2xl font-bold">{stat.value}</p>
                                        {totalRecords > 0 && i > 0 && (
                                            <p className="text-xs text-muted-foreground">
                                                {((stat.value / totalRecords) * 100).toFixed(1)}%
                                            </p>
                                        )}
                                    </div>
                                    <div className={`h-12 w-12 rounded-lg ${stat.color} flex items-center justify-center`}>
                                        <stat.icon className="h-6 w-6" />
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Student-wise Report */}
                {report?.length > 0 && (
                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Student-wise Report</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Class</TableHead>
                                        <TableHead className="text-center">Present</TableHead>
                                        <TableHead className="text-center">Absent</TableHead>
                                        <TableHead className="text-center">Late</TableHead>
                                        <TableHead className="text-center">Total</TableHead>
                                        <TableHead className="text-center">Percentage</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {report.map((row) => {
                                        const pct = row.total > 0 ? ((row.present / row.total) * 100) : 0;
                                        return (
                                            <TableRow key={row.student_id}>
                                                <TableCell className="font-medium">{row.student_name}</TableCell>
                                                <TableCell>{row.class_name}</TableCell>
                                                <TableCell className="text-center text-emerald-600">{row.present}</TableCell>
                                                <TableCell className="text-center text-red-600">{row.absent}</TableCell>
                                                <TableCell className="text-center text-amber-600">{row.late}</TableCell>
                                                <TableCell className="text-center">{row.total}</TableCell>
                                                <TableCell>
                                                    <div className="flex items-center gap-2">
                                                        <Progress
                                                            value={pct}
                                                            className="h-2 flex-1"
                                                            indicatorClassName={
                                                                pct >= 75 ? 'bg-emerald-500' : pct >= 50 ? 'bg-amber-500' : 'bg-red-500'
                                                            }
                                                        />
                                                        <span className="text-xs font-medium w-10 text-right">{pct.toFixed(0)}%</span>
                                                    </div>
                                                </TableCell>
                                            </TableRow>
                                        );
                                    })}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                )}

                {report !== undefined && report.length === 0 && (
                    <Card>
                        <CardContent className="py-8 text-center text-muted-foreground">
                            No attendance data found. Select a class and date range to view the report.
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}
