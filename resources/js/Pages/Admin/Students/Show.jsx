import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { ArrowLeft, Pencil } from 'lucide-react';

export default function Show({ student }) {
    return (
        <AppLayout title={student.user?.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Link href="/students"><Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button></Link>
                        <div><h1 className="text-2xl font-bold tracking-tight">{student.user?.name}</h1><p className="text-muted-foreground">Admission #{student.admission_number}</p></div>
                    </div>
                    <Link href={`/students/${student.id}/edit`}><Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button></Link>
                </div>

                <Card>
                    <CardContent className="p-6">
                        <div className="flex items-start gap-6">
                            <div className="h-20 w-20 rounded-full bg-primary/20 flex items-center justify-center text-2xl font-bold text-primary-foreground">
                                {student.user?.name?.charAt(0)}
                            </div>
                            <div className="flex-1 grid gap-3 md:grid-cols-3">
                                <div><p className="text-sm text-muted-foreground">Email</p><p className="font-medium">{student.user?.email}</p></div>
                                <div><p className="text-sm text-muted-foreground">Phone</p><p className="font-medium">{student.user?.phone || '-'}</p></div>
                                <div><p className="text-sm text-muted-foreground">Class</p><p className="font-medium">{student.class?.name} - {student.section?.name || 'N/A'}</p></div>
                                <div><p className="text-sm text-muted-foreground">Roll Number</p><p className="font-medium">{student.roll_number || '-'}</p></div>
                                <div><p className="text-sm text-muted-foreground">Admission Date</p><p className="font-medium">{student.admission_date}</p></div>
                                <div><p className="text-sm text-muted-foreground">Status</p><Badge variant={student.active_status ? 'default' : 'secondary'}>{student.active_status ? 'Active' : 'Inactive'}</Badge></div>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <Tabs defaultValue="personal">
                    <TabsList>
                        <TabsTrigger value="personal">Personal Info</TabsTrigger>
                        <TabsTrigger value="attendance">Attendance</TabsTrigger>
                        <TabsTrigger value="fees">Fees</TabsTrigger>
                        <TabsTrigger value="exams">Exams</TabsTrigger>
                    </TabsList>
                    <TabsContent value="personal" className="mt-4">
                        <Card><CardContent className="p-6 grid gap-3 md:grid-cols-2">
                            <div><p className="text-sm text-muted-foreground">Gender</p><p className="font-medium capitalize">{student.user?.gender || '-'}</p></div>
                            <div><p className="text-sm text-muted-foreground">Blood Group</p><p className="font-medium">{student.user?.blood_group || '-'}</p></div>
                            <div><p className="text-sm text-muted-foreground">Religion</p><p className="font-medium">{student.user?.religion || '-'}</p></div>
                            <div><p className="text-sm text-muted-foreground">Address</p><p className="font-medium">{student.user?.address || '-'}</p></div>
                        </CardContent></Card>
                    </TabsContent>
                    <TabsContent value="attendance" className="mt-4">
                        <Card><CardContent className="p-6 text-sm text-muted-foreground">Attendance records will appear here.</CardContent></Card>
                    </TabsContent>
                    <TabsContent value="fees" className="mt-4">
                        <Card><CardContent className="p-6 text-sm text-muted-foreground">Fee payment records will appear here.</CardContent></Card>
                    </TabsContent>
                    <TabsContent value="exams" className="mt-4">
                        <Card><CardContent className="p-6 text-sm text-muted-foreground">Exam results will appear here.</CardContent></Card>
                    </TabsContent>
                </Tabs>
            </div>
        </AppLayout>
    );
}
