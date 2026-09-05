import AppLayout from '@/layouts/AppLayout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft } from 'lucide-react';
import { router } from '@inertiajs/react';

export default function Invoices({ invoices }) {
    return (
        <AppLayout title="Invoices">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Invoices</h1>
                        <p className="text-muted-foreground">View your billing invoices.</p>
                    </div>
                    <Button variant="outline" onClick={() => router.visit(route('admin.billing.index'))}>
                        <ArrowLeft className="mr-2 h-4 w-4" /> Back
                    </Button>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Invoice #</TableHead>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Amount</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="w-[80px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {invoices?.map((invoice) => (
                                    <TableRow key={invoice.id}>
                                        <TableCell className="font-medium">INV-{invoice.id}</TableCell>
                                        <TableCell>{invoice.date}</TableCell>
                                        <TableCell>{invoice.amount}</TableCell>
                                        <TableCell>{invoice.status}</TableCell>
                                        <TableCell>
                                            <Button variant="ghost" size="sm">Download</Button>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!invoices || invoices.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={5} className="text-center py-12 text-muted-foreground">No invoices yet.</TableCell>
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
