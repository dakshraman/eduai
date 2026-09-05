import AppLayout from '@/layouts/AppLayout';
import { useForm, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Edit({ student, classes }) {
    const { data, setData, put, processing, errors } = useForm({
        name: student.user?.name || '',
        email: student.user?.email || '',
        phone: student.user?.phone || '',
        gender: student.user?.gender || '',
        date_of_birth: student.user?.date_of_birth || '',
        class_id: student.class_id ? String(student.class_id) : '',
        section_id: student.section_id ? String(student.section_id) : '',
        admission_number: student.admission_number || '',
        roll_number: student.roll_number || '',
        admission_date: student.admission_date || '',
    });

    const submit = (e) => { e.preventDefault(); put(`/students/${student.id}`); };

    return (
        <AppLayout title={`Edit ${student.user?.name}`}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div><h1 className="text-2xl font-bold tracking-tight">Edit Student</h1><p className="text-muted-foreground">Update student information</p></div>
                    <Link href="/students"><Button variant="outline">Cancel</Button></Link>
                </div>
                <form onSubmit={submit}>
                    <Card>
                        <CardHeader><CardTitle>Personal Information</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2"><Label>Full Name *</Label><Input value={data.name} onChange={(e) => setData('name', e.target.value)} />{errors.name && <p className="text-sm text-destructive">{errors.name}</p>}</div>
                                <div className="space-y-2"><Label>Email *</Label><Input type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} />{errors.email && <p className="text-sm text-destructive">{errors.email}</p>}</div>
                                <div className="space-y-2"><Label>Phone</Label><Input value={data.phone} onChange={(e) => setData('phone', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Gender</Label><Select value={data.gender} onValueChange={(v) => setData('gender', v)}><SelectTrigger><SelectValue placeholder="Select" /></SelectTrigger><SelectContent><SelectItem value="male">Male</SelectItem><SelectItem value="female">Female</SelectItem><SelectItem value="other">Other</SelectItem></SelectContent></Select></div>
                                <div className="space-y-2"><Label>Date of Birth</Label><Input type="date" value={data.date_of_birth} onChange={(e) => setData('date_of_birth', e.target.value)} /></div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card className="mt-4">
                        <CardHeader><CardTitle>Student Information</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2"><Label>Class *</Label><Select value={data.class_id} onValueChange={(v) => setData('class_id', v)}><SelectTrigger><SelectValue placeholder="Select class" /></SelectTrigger><SelectContent>{classes?.map((c) => <SelectItem key={c.id} value={String(c.id)}>{c.name}</SelectItem>)}</SelectContent></Select></div>
                                <div className="space-y-2"><Label>Admission Number *</Label><Input value={data.admission_number} onChange={(e) => setData('admission_number', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Roll Number</Label><Input value={data.roll_number} onChange={(e) => setData('roll_number', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Admission Date</Label><Input type="date" value={data.admission_date} onChange={(e) => setData('admission_date', e.target.value)} /></div>
                            </div>
                        </CardContent>
                    </Card>
                    <div className="flex justify-end gap-2 mt-4">
                        <Link href="/students"><Button variant="outline" type="button">Cancel</Button></Link>
                        <Button type="submit" disabled={processing}>{processing ? 'Updating...' : 'Update Student'}</Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
