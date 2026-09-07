import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, DollarSign } from 'lucide-react';

const STATUS_STYLES = {
    paid: 'bg-emerald-100 text-emerald-700',
    partial: 'bg-amber-100 text-amber-700',
    unpaid: 'bg-red-100 text-red-700',
};

export default function Fees({ student, structures, payments, summary }) {
    const statCards = [
        { title: 'Total Due', value: `$${Number(summary.totalDue ?? 0).toLocaleString()}`, color: 'bg-secondary/50' },
        { title: 'Total Paid', value: `$${Number(summary.totalPaid ?? 0).toLocaleString()}`, color: 'bg-primary/50' },
        { title: 'Outstanding', value: `$${Number(summary.outstanding ?? 0).toLocaleString()}`, color: 'bg-accent/50' },
    ];

    return (
        <AppLayout title={`${student.user?.name} - Fees`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href={`/parent/children/${student.id}`}>
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Fees — {student.user?.name}</h1>
                        <p className="text-muted-foreground">Fee structure and payment history</p>
                    </div>
                </div>

                {/* Summary */}
                <div className="grid gap-4 md:grid-cols-3">
                    {statCards.map((stat, i) => (
                        <Card key={i}>
                            <CardContent className="p-6 flex items-center gap-4">
                                <div className={`h-12 w-12 rounded-lg ${stat.color} flex items-center justify-center`}>
                                    <DollarSign className="h-6 w-6" />
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">{stat.title}</p>
                                    <p className="text-2xl font-bold">{stat.value}</p>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Fee structures */}
                <Card>
                    <CardHeader><CardTitle className="text-base">Fee Structure</CardTitle></CardHeader>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Category</TableHead>
                                    <TableHead className="text-right">Amount</TableHead>
                                    <TableHead className="text-right">Paid</TableHead>
                                    <TableHead className="text-right">Balance</TableHead>
                                    <TableHead>Due Date</TableHead>
                                    <TableHead>Status</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {structures?.length > 0 ? structures.map((s) => (
                                    <TableRow key={s.id}>
                                        <TableCell className="font-medium">{s.category}</TableCell>
                                        <TableCell className="text-right">${s.amount.toLocaleString()}</TableCell>
                                        <TableCell className="text-right text-emerald-600">${s.paid.toLocaleString()}</TableCell>
                                        <TableCell className="text-right font-medium">${s.balance.toLocaleString()}</TableCell>
                                        <TableCell>{s.due_date || '-'}</TableCell>
                                        <TableCell>
                                            <Badge className={STATUS_STYLES[s.status] || 'bg-gray-100 text-gray-600'}>
                                                {s.status}
                                            </Badge>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={6} className="text-center py-8 text-muted-foreground">
                                            No fee structures set for this class.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                {/* Payments */}
                <Card>
                    <CardHeader><CardTitle className="text-base">Payment History</CardTitle></CardHeader>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Category</TableHead>
                                    <TableHead className="text-right">Amount</TableHead>
                                    <TableHead>Method</TableHead>
                                    <TableHead>Receipt</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {payments?.length > 0 ? payments.map((p) => (
                                    <TableRow key={p.id}>
                                        <TableCell>{p.payment_date}</TableCell>
                                        <TableCell>{p.feeStructure?.feeCategory?.name ?? '-'}</TableCell>
                                        <TableCell className="text-right font-medium">${p.amount_paid}</TableCell>
                                        <TableCell className="capitalize">{p.payment_method}</TableCell>
                                        <TableCell className="font-mono text-xs">{p.receipt_number || '-'}</TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={5} className="text-center py-8 text-muted-foreground">
                                            No payments yet.
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