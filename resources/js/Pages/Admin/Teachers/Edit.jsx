import AppLayout from '@/layouts/AppLayout';
import { useForm, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

export default function Edit({ teacher }) {
    const { data, setData, put, processing, errors } = useForm({
        name: teacher.user?.name || '',
        email: teacher.user?.email || '',
        phone: teacher.user?.phone || '',
        employee_id: teacher.employee_id || '',
        designation: teacher.designation || '',
        department: teacher.department || '',
        salary: teacher.salary || '',
        qualification: teacher.qualification || '',
        experience: teacher.experience || '',
    });

    const submit = (e) => { e.preventDefault(); put(`/teachers/${teacher.id}`); };

    return (
        <AppLayout title={`Edit ${teacher.user?.name}`}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div><h1 className="text-2xl font-bold tracking-tight">Edit Teacher</h1><p className="text-muted-foreground">Update teacher information</p></div>
                    <Link href="/teachers"><Button variant="outline">Cancel</Button></Link>
                </div>
                <form onSubmit={submit}>
                    <Card>
                        <CardHeader><CardTitle>Personal Information</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2"><Label>Full Name *</Label><Input value={data.name} onChange={(e) => setData('name', e.target.value)} />{errors.name && <p className="text-sm text-destructive">{errors.name}</p>}</div>
                                <div className="space-y-2"><Label>Email *</Label><Input type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} />{errors.email && <p className="text-sm text-destructive">{errors.email}</p>}</div>
                                <div className="space-y-2"><Label>Phone</Label><Input value={data.phone} onChange={(e) => setData('phone', e.target.value)} /></div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card className="mt-4">
                        <CardHeader><CardTitle>Professional Information</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2"><Label>Employee ID *</Label><Input value={data.employee_id} onChange={(e) => setData('employee_id', e.target.value)} />{errors.employee_id && <p className="text-sm text-destructive">{errors.employee_id}</p>}</div>
                                <div className="space-y-2"><Label>Designation</Label><Input value={data.designation} onChange={(e) => setData('designation', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Department</Label><Input value={data.department} onChange={(e) => setData('department', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Salary</Label><Input type="number" value={data.salary} onChange={(e) => setData('salary', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Qualification</Label><Input value={data.qualification} onChange={(e) => setData('qualification', e.target.value)} /></div>
                                <div className="space-y-2"><Label>Experience (years)</Label><Input type="number" value={data.experience} onChange={(e) => setData('experience', e.target.value)} /></div>
                            </div>
                        </CardContent>
                    </Card>
                    <div className="flex justify-end gap-2 mt-4">
                        <Link href="/teachers"><Button variant="outline" type="button">Cancel</Button></Link>
                        <Button type="submit" disabled={processing}>{processing ? 'Updating...' : 'Update Teacher'}</Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
