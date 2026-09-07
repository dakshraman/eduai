import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Edit({ event }) {
    const { data, setData, put, processing, errors } = useForm({
        title: event.title || '',
        description: event.description || '',
        event_date: event.event_date || '',
        event_time: event.event_time || '',
        location: event.location || '',
    });

    const submit = (e) => {
        e.preventDefault();
        put(`/events/${event.id}`);
    };

    return (
        <AppLayout title={`Edit ${event.title}`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/events">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Edit Event</h1>
                        <p className="text-muted-foreground">Update event details</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Event Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="title">Title *</Label>
                                <Input id="title" value={data.title} onChange={(e) => setData('title', e.target.value)} />
                                {errors.title && <p className="text-sm text-destructive">{errors.title}</p>}
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="event_date">Date *</Label>
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
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Update Event</Button>
                                <Link href="/events"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
