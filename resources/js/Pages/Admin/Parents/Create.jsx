import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Checkbox } from '@/components/ui/checkbox';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Create({ students }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        phone: '',
        occupation: '',
        relation_type: '',
        address: '',
        student_ids: [],
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.parents.store'));
    };

    const toggleStudent = (id) => {
        setData('student_ids', data.student_ids.includes(id)
            ? data.student_ids.filter((s) => s !== id)
            : [...data.student_ids, id]
        );
    };

    return (
        <AppLayout title="Add Parent">
            <div className="space-y-6">
                <Link href={route('admin.parents.index')}>
                    <Button variant="outline"><ArrowLeft className="mr-2 h-4 w-4" /> Back</Button>
                </Link>

                <form onSubmit={handleSubmit} className="space-y-6 max-w-2xl">
                    <Card>
                        <CardHeader><CardTitle className="text-base">User Information</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="name">Full Name</Label>
                                    <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                                    {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="email">Email</Label>
                                    <Input id="email" type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} />
                                    {errors.email && <p className="text-sm text-destructive">{errors.email}</p>}
                                </div>
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="password">Password</Label>
                                    <Input id="password" type="password" value={data.password} onChange={(e) => setData('password', e.target.value)} />
                                    {errors.password && <p className="text-sm text-destructive">{errors.password}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input id="phone" value={data.phone} onChange={(e) => setData('phone', e.target.value)} />
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader><CardTitle className="text-base">Parent Details</CardTitle></CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="occupation">Occupation</Label>
                                    <Input id="occupation" value={data.occupation} onChange={(e) => setData('occupation', e.target.value)} />
                                </div>
                                <div className="space-y-2">
                                    <Label>Relation Type</Label>
                                    <Select value={data.relation_type} onValueChange={(v) => setData('relation_type', v)}>
                                        <SelectTrigger><SelectValue placeholder="Select" /></SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="father">Father</SelectItem>
                                            <SelectItem value="mother">Mother</SelectItem>
                                            <SelectItem value="guardian">Guardian</SelectItem>
                                            <SelectItem value="other">Other</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    {errors.relation_type && <p className="text-sm text-destructive">{errors.relation_type}</p>}
                                </div>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="address">Address</Label>
                                <Textarea id="address" rows={2} value={data.address} onChange={(e) => setData('address', e.target.value)} />
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader><CardTitle className="text-base">Linked Students</CardTitle></CardHeader>
                        <CardContent>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
                                {students?.map((student) => (
                                    <label key={student.id} className="flex items-center space-x-2 p-2 rounded hover:bg-muted cursor-pointer">
                                        <Checkbox
                                            checked={data.student_ids.includes(student.id)}
                                            onCheckedChange={() => toggleStudent(student.id)}
                                        />
                                        <span className="text-sm">{student.name} — {student.class?.name}</span>
                                    </label>
                                ))}
                                {(!students || students.length === 0) && (
                                    <p className="text-sm text-muted-foreground">No students available.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    <Button type="submit" disabled={processing}>Create Parent</Button>
                </form>
            </div>
        </AppLayout>
    );
}
