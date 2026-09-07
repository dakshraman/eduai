import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ArrowLeft } from 'lucide-react';

export default function Create({ classes }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        class_id: '',
        subject_code: '',
        pass_mark: 40,
        full_mark: 100,
    });

    const submit = (e) => {
        e.preventDefault();
        post('/subjects');
    };

    return (
        <AppLayout title="Create Subject">
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/subjects">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Create Subject</h1>
                        <p className="text-muted-foreground">Add a new subject</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Subject Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Subject Name *</Label>
                                <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="e.g. Mathematics" />
                                {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label>Class *</Label>
                                <Select value={data.class_id} onValueChange={(v) => setData('class_id', v)}>
                                    <SelectTrigger><SelectValue placeholder="Select class" /></SelectTrigger>
                                    <SelectContent>
                                        {classes?.map((cls) => (
                                            <SelectItem key={cls.id} value={String(cls.id)}>{cls.name}</SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                {errors.class_id && <p className="text-sm text-destructive">{errors.class_id}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="subject_code">Subject Code</Label>
                                <Input id="subject_code" value={data.subject_code} onChange={(e) => setData('subject_code', e.target.value)} placeholder="e.g. MATH101" />
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="pass_mark">Pass Mark</Label>
                                    <Input id="pass_mark" type="number" value={data.pass_mark} onChange={(e) => setData('pass_mark', parseInt(e.target.value) || 0)} />
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="full_mark">Full Mark</Label>
                                    <Input id="full_mark" type="number" value={data.full_mark} onChange={(e) => setData('full_mark', parseInt(e.target.value) || 100)} />
                                </div>
                            </div>
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Create Subject</Button>
                                <Link href="/subjects"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
