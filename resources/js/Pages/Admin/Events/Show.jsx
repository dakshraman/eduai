import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Pencil, ArrowLeft, Calendar, MapPin, Clock, User } from 'lucide-react';

export default function Show({ event }) {
    return (
        <AppLayout title={event.title}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/events">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{event.title}</h1>
                            <p className="text-muted-foreground">Event details</p>
                        </div>
                    </div>
                    <Link href={`/events/${event.id}/edit`}>
                        <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle className="text-base flex items-center gap-2">
                            <Calendar className="h-4 w-4" />
                            Event Information
                        </CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-4">
                        <div className="grid gap-4 md:grid-cols-2">
                            <div className="space-y-1">
                                <p className="text-sm text-muted-foreground">Date</p>
                                <p className="font-medium">{event.event_date}</p>
                            </div>
                            <div className="space-y-1">
                                <p className="text-sm text-muted-foreground">Time</p>
                                <p className="font-medium">{event.event_time || 'Not set'}</p>
                            </div>
                            <div className="space-y-1">
                                <p className="text-sm text-muted-foreground">Location</p>
                                <p className="font-medium flex items-center gap-1">
                                    <MapPin className="h-3 w-3" />
                                    {event.location || 'Not set'}
                                </p>
                            </div>
                            <div className="space-y-1">
                                <p className="text-sm text-muted-foreground">Created by</p>
                                <p className="font-medium flex items-center gap-1">
                                    <User className="h-3 w-3" />
                                    {event.creator?.name || 'Unknown'}
                                </p>
                            </div>
                        </div>
                        {event.description && (
                            <div className="space-y-1">
                                <p className="text-sm text-muted-foreground">Description</p>
                                <p className="whitespace-pre-wrap">{event.description}</p>
                            </div>
                        )}
                        <Badge variant={event.active_status ? 'default' : 'secondary'}>
                            {event.active_status ? 'Active' : 'Inactive'}
                        </Badge>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
