import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Plus, MapPin, Calendar } from 'lucide-react';

export default function Index({ events }) {
    return (
        <AppLayout title="Events">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Events</h1>
                        <p className="text-muted-foreground">Manage school events.</p>
                    </div>
                    <Link href={route('admin.events.create')}>
                        <Button><Plus className="mr-2 h-4 w-4" /> Add Event</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {events?.map((event) => (
                        <Card key={event.id} className="hover:shadow-md transition-shadow">
                            <CardHeader className="pb-3">
                                <div className="flex items-start justify-between">
                                    <CardTitle className="text-base">{event.title}</CardTitle>
                                    <Badge variant="secondary">
                                        <Calendar className="mr-1 h-3 w-3" />
                                        {event.event_date}
                                    </Badge>
                                </div>
                                {event.event_time && (
                                    <p className="text-xs text-muted-foreground">Time: {event.event_time}</p>
                                )}
                            </CardHeader>
                            <CardContent>
                                {event.location && (
                                    <p className="text-sm flex items-center text-muted-foreground">
                                        <MapPin className="mr-1 h-3 w-3" /> {event.location}
                                    </p>
                                )}
                                {event.description && (
                                    <p className="text-sm text-muted-foreground mt-2 line-clamp-2">{event.description}</p>
                                )}
                            </CardContent>
                        </Card>
                    ))}
                    {(!events || events.length === 0) && (
                        <Card className="col-span-full">
                            <CardContent className="py-8 text-center text-muted-foreground">No events yet.</CardContent>
                        </Card>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
