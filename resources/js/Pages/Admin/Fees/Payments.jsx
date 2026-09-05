import AppLayout from '@/layouts/AppLayout';
import { Link, useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { useState } from 'react';
import { Plus, Receipt } from 'lucide-react';

export default function Payments({ payments, students }) {
    const [open, setOpen] = useState(false);
    const { data, setData, post, processing, reset } = useForm({
        student_id: '',
        amount: '',
        method: 'cash',
        note: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.fees.payments.store'), {
            onSuccess: () => { reset(); setOpen(false); },
        });
    };

    return (
        <AppLayout title="Payments">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Payments</h1>
                        <p className="text-muted-foreground">Track and record fee payments.</p>
                    </div>
                    <Dialog open={open} onOpenChange={setOpen}>
                        <DialogTrigger asChild>
                            <Button><Plus className="mr-2 h-4 w-4" /> Record Payment</Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>Record Payment</DialogTitle>
                            </DialogHeader>
                            <form onSubmit={handleSubmit} className="space-y-4">
                                <div className="space-y-2">
                                    <Label>Student</Label>
                                    <Select value={data.student_id} onValueChange={(v) => setData('student_id', v)}>
                                        <SelectTrigger><SelectValue placeholder="Select student" /></SelectTrigger>
                                        <SelectContent>
                                            {students?.map((s) => (
                                                <SelectItem key={s.id} value={String(s.id)}>{s.name}</SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="amount">Amount</Label>
                                    <Input id="amount" type="number" value={data.amount} onChange={(e) => setData('amount', e.target.value)} />
                                </div>
                                <div className="space-y-2">
                                    <Label>Method</Label>
                                    <Select value={data.method} onValueChange={(v) => setData('method', v)}>
                                        <SelectTrigger><SelectValue /></SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="cash">Cash</SelectItem>
                                            <SelectItem value="bank_transfer">Bank Transfer</SelectItem>
                                            <SelectItem value="card">Card</SelectItem>
                                            <SelectItem value="online">Online</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="note">Note</Label>
                                    <Input id="note" value={data.note} onChange={(e) => setData('note', e.target.value)} placeholder="Optional note" />
                                </div>
                                <Button type="submit" disabled={processing} className="w-full">Save Payment</Button>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Student</TableHead>
                                    <TableHead>Amount</TableHead>
                                    <TableHead>Method</TableHead>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Receipt</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {payments?.map((p) => (
                                    <TableRow key={p.id}>
                                        <TableCell className="font-medium">{p.student?.name}</TableCell>
                                        <TableCell>{p.amount}</TableCell>
                                        <TableCell className="capitalize">{p.method?.replace('_', ' ')}</TableCell>
                                        <TableCell>{p.created_at}</TableCell>
                                        <TableCell>
                                            <Link href={route('admin.fees.receipt', p.id)} className="text-primary hover:underline">
                                                <Receipt className="inline h-4 w-4 mr-1" /> View
                                            </Link>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!payments || payments.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={5} className="text-center text-muted-foreground">No payments yet.</TableCell>
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
