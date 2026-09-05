import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ArrowLeft } from 'lucide-react';

const EXAM_TYPES = [
    { value: 'unit', label: 'Unit Test' },
    { value: 'midterm', label: 'Midterm' },
    { value: 'final', label: 'Final' },
    { value: 'assignment', label: 'Assignment' },
];

export default function Create({ classes }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        class_id: '',
        start_date: '',
        end_date: '',
        exam_type: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/exams');
    };

    return (
        <AppLayout title="Create Exam">
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/exams">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Create Exam</h1>
                        <p className="text-muted-foreground">Add a new examination</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Exam Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Exam Name</Label>
                                <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="e.g. Midterm Exam 2026" />
                                {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label>Class</Label>
                                <Select value={data.class_id} onValueChange={(val) => setData('class_id', val)}>
                                    <SelectTrigger><SelectValue placeholder="Select class" /></SelectTrigger>
                                    <SelectContent>
                                        {classes?.map((c) => <SelectItem key={c.id} value={String(c.id)}>{c.name}</SelectItem>)}
                                    </SelectContent>
                                </Select>
                                {errors.class_id && <p className="text-sm text-destructive">{errors.class_id}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label>Exam Type</Label>
                                <Select value={data.exam_type} onValueChange={(val) => setData('exam_type', val)}>
                                    <SelectTrigger><SelectValue placeholder="Select type" /></SelectTrigger>
                                    <SelectContent>
                                        {EXAM_TYPES.map((t) => <SelectItem key={t.value} value={t.value}>{t.label}</SelectItem>)}
                                    </SelectContent>
                                </Select>
                                {errors.exam_type && <p className="text-sm text-destructive">{errors.exam_type}</p>}
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="start_date">Start Date</Label>
                                    <Input id="start_date" type="date" value={data.start_date} onChange={(e) => setData('start_date', e.target.value)} />
                                    {errors.start_date && <p className="text-sm text-destructive">{errors.start_date}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="end_date">End Date</Label>
                                    <Input id="end_date" type="date" value={data.end_date} onChange={(e) => setData('end_date', e.target.value)} />
                                    {errors.end_date && <p className="text-sm text-destructive">{errors.end_date}</p>}
                                </div>
                            </div>
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Create Exam</Button>
                                <Link href="/exams"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
