import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Edit({ notice }) {
    const { data, setData, put, processing, errors } = useForm({
        title: notice.title || '',
        message: notice.message || '',
        notice_type: notice.notice_type || 'general',
        published_at: notice.published_at ? notice.published_at.split('T')[0] : '',
    });

    const submit = (e) => {
        e.preventDefault();
        put(`/notices/${notice.id}`);
    };

    return (
        <AppLayout title={`Edit ${notice.title}`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/notices">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Edit Notice</h1>
                        <p className="text-muted-foreground">Update notice details</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Notice Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="title">Title *</Label>
                                <Input id="title" value={data.title} onChange={(e) => setData('title', e.target.value)} />
                                {errors.title && <p className="text-sm text-destructive">{errors.title}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label>Notice Type *</Label>
                                <Select value={data.notice_type} onValueChange={(v) => setData('notice_type', v)}>
                                    <SelectTrigger><SelectValue /></SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="general">General</SelectItem>
                                        <SelectItem value="exam">Exam</SelectItem>
                                        <SelectItem value="event">Event</SelectItem>
                                        <SelectItem value="holiday">Holiday</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="published_at">Publish Date</Label>
                                <Input id="published_at" type="date" value={data.published_at} onChange={(e) => setData('published_at', e.target.value)} />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="message">Message *</Label>
                                <Textarea id="message" rows={6} value={data.message} onChange={(e) => setData('message', e.target.value)} />
                                {errors.message && <p className="text-sm text-destructive">{errors.message}</p>}
                            </div>
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Update Notice</Button>
                                <Link href="/notices"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
