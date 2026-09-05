import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        message: '',
        notice_type: 'general',
        published_at: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.notices.store'));
    };

    return (
        <AppLayout title="Create Notice">
            <div className="space-y-6">
                <Link href={route('admin.notices.index')}>
                    <Button variant="outline"><ArrowLeft className="mr-2 h-4 w-4" /> Back</Button>
                </Link>

                <Card>
                    <CardHeader><CardTitle className="text-base">Create Notice</CardTitle></CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
                            <div className="space-y-2">
                                <Label htmlFor="title">Title</Label>
                                <Input id="title" value={data.title} onChange={(e) => setData('title', e.target.value)} />
                                {errors.title && <p className="text-sm text-destructive">{errors.title}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label>Notice Type</Label>
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
                                <Label htmlFor="message">Message</Label>
                                <Textarea id="message" rows={6} value={data.message} onChange={(e) => setData('message', e.target.value)} />
                                {errors.message && <p className="text-sm text-destructive">{errors.message}</p>}
                            </div>
                            <Button type="submit" disabled={processing}>Publish Notice</Button>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
