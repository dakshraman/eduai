import AppLayout from '@/layouts/AppLayout';
import { router } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ClipboardCheck } from 'lucide-react';

const STATUS_STYLES = {
    present: 'bg-emerald-100 text-emerald-700',
    absent: 'bg-red-100 text-red-700',
    late: 'bg-amber-100 text-amber-700',
    half_day: 'bg-blue-100 text-blue-700',
};

export default function Index({ attendances, summary }) {
    const statCards = [
        { title: 'Total Days', value: summary.total ?? 0 },
        { title: 'Present', value: summary.present ?? 0 },
        { title: 'Absent', value: summary.absent ?? 0 },
        { title: 'Attendance %', value: `${summary.percentage ?? 0}%` },
    ];

    return (
        <AppLayout title="My Attendance">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">My Attendance</h1>
                    <p className="text-muted-foreground">Your attendance record</p>
                </div>

                {/* Summary */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    {statCards.map((stat, i) => (
                        <Card key={i}>
                            <CardContent className="p-6 flex items-center gap-4">
                                <div className="h-12 w-12 rounded-lg bg-secondary/50 flex items-center justify-center">
                                    <ClipboardCheck className="h-6 w-6" />
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">{stat.title}</p>
                                    <p className="text-2xl font-bold">{stat.value}</p>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Attendance table */}
                <Card>
                    <CardHeader><CardTitle className="text-base">Attendance History</CardTitle></CardHeader>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Remark</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {attendances?.data?.length > 0 ? attendances.data.map((att) => (
                                    <TableRow key={att.id}>
                                        <TableCell>{att.date}</TableCell>
                                        <TableCell>{att.class?.name ?? '-'}</TableCell>
                                        <TableCell>
                                            <Badge className={STATUS_STYLES[att.status] || 'bg-gray-100 text-gray-600'}>
                                                {att.status}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-muted-foreground">{att.remark || '-'}</TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={4} className="text-center py-8 text-muted-foreground">
                                            No attendance records yet.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                {attendances?.links && (
                    <div className="flex items-center justify-between text-sm text-muted-foreground">
                        <span>Showing {attendances.from ?? 0}–{attendances.to ?? 0} of {attendances.total}</span>
                        <div className="flex gap-2">
                            {attendances.links.map((link, i) => (
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