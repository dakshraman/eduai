import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Printer, ArrowLeft } from 'lucide-react';

export default function Receipt({ payment }) {
    const handlePrint = () => window.print();

    return (
        <AppLayout title="Payment Receipt">
            <div className="space-y-6">
                <div className="flex items-center justify-between no-print">
                    <Link href={route('admin.fees.payments.index')}>
                        <Button variant="outline"><ArrowLeft className="mr-2 h-4 w-4" /> Back to Payments</Button>
                    </Link>
                    <Button onClick={handlePrint}><Printer className="mr-2 h-4 w-4" /> Print Receipt</Button>
                </div>

                <Card className="print:shadow-none print:border-0">
                    <CardContent className="p-8">
                        <div className="text-center mb-8">
                            <h1 className="text-2xl font-bold">School Name</h1>
                            <p className="text-muted-foreground">123 Education Street, City</p>
                            <p className="text-muted-foreground">Phone: +1 234 567 890</p>
                        </div>

                        <div className="text-center mb-6">
                            <h2 className="text-lg font-semibold border-b pb-2">PAYMENT RECEIPT</h2>
                            <p className="text-sm text-muted-foreground mt-1">Receipt #{payment?.id}</p>
                        </div>

                        <div className="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p className="text-sm text-muted-foreground">Student Name</p>
                                <p className="font-medium">{payment?.student?.name}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Class</p>
                                <p className="font-medium">{payment?.student?.class?.name}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Payment Date</p>
                                <p className="font-medium">{payment?.created_at}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Payment Method</p>
                                <p className="font-medium capitalize">{payment?.method?.replace('_', ' ')}</p>
                            </div>
                        </div>

                        <div className="border-t pt-4">
                            <div className="flex justify-between items-center">
                                <span className="text-lg font-semibold">Amount Paid</span>
                                <span className="text-2xl font-bold">{payment?.amount}</span>
                            </div>
                        </div>

                        {payment?.note && (
                            <div className="mt-4 text-sm text-muted-foreground">
                                <p className="font-medium">Note:</p>
                                <p>{payment.note}</p>
                            </div>
                        )}

                        <div className="mt-8 text-center text-sm text-muted-foreground">
                            <p>Thank you for your payment!</p>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
