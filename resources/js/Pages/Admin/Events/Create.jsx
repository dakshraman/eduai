import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        description: '',
        event_date: '',
        event_time: '',
        location: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.events.store'));
    };

    return (
        <AppLayout title="Create Event">
            <div className="space-y-6">
                <Link href={route('admin.events.index')}>
                    <Button variant="outline"><ArrowLeft className="mr-2 h-4 w-4" /> Back</Button>
                </Link>

                <Card>
                    <CardHeader><CardTitle className="text-base">Create Event</CardTitle></CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
                            <div className="space-y-2">
                                <Label htmlFor="title">Title</Label>
                                <Input id="title" value={data.title} onChange={(e) => setData('title', e.target.value)} />
                                {errors.title && <p className="text-sm text-destructive">{errors.title}</p>}
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="event_date">Date</Label>
                                    <Input id="event_date" type="date" value={data.event_date} onChange={(e) => setData('event_date', e.target.value)} />
                                    {errors.event_date && <p className="text-sm text-destructive">{errors.event_date}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="event_time">Time</Label>
                                    <Input id="event_time" type="time" value={data.event_time} onChange={(e) => setData('event_time', e.target.value)} />
                                </div>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="location">Location</Label>
                                <Input id="location" value={data.location} onChange={(e) => setData('location', e.target.value)} placeholder="e.g. Main Auditorium" />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="description">Description</Label>
                                <Textarea id="description" rows={4} value={data.description} onChange={(e) => setData('description', e.target.value)} />
                            </div>
                            <Button type="submit" disabled={processing}>Create Event</Button>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
