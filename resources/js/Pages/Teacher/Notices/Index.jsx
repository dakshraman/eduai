import AppLayout from '@/layouts/AppLayout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Bell, CalendarDays } from 'lucide-react';

export default function Index({ notices, events }) {
    return (
        <AppLayout title="Notices & Events">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Notices & Events</h1>
                    <p className="text-muted-foreground">School announcements and upcoming events</p>
                </div>

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Notices */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><Bell className="h-4 w-4" /> Notices</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {notices?.data?.length > 0 ? notices.data.map((notice) => (
                                    <div key={notice.id} className="rounded-xl border border-border p-4">
                                        <div className="flex items-center justify-between mb-2">
                                            <p className="font-semibold text-sm">{notice.title}</p>
                                            <Badge variant="secondary">{notice.notice_type}</Badge>
                                        </div>
                                        <p className="text-sm text-muted-foreground whitespace-pre-line">{notice.message}</p>
                                        <p className="text-xs text-muted-foreground mt-3">
                                            {notice.published_at} · {notice.creator?.name ?? 'School'}
                                        </p>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No notices yet.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Events */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><CalendarDays className="h-4 w-4" /> Upcoming Events</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {events?.length > 0 ? events.map((event) => (
                                    <div key={event.id} className="flex gap-4 rounded-xl border border-border p-4">
                                        <div className="flex flex-col items-center justify-center rounded-lg bg-primary/10 px-3 py-2 min-w-14">
                                            <span className="text-lg font-bold text-primary leading-none">
                                                {new Date(event.event_date).getDate()}
                                            </span>
                                            <span className="text-[10px] uppercase text-muted-foreground">
                                                {new Date(event.event_date).toLocaleString('en', { month: 'short' })}
                                            </span>
                                        </div>
                                        <div className="flex-1">
                                            <p className="font-semibold text-sm">{event.title}</p>
                                            <p className="text-xs text-muted-foreground mt-1 line-clamp-2">{event.description}</p>
                                            <p className="text-xs text-muted-foreground mt-2">
                                                {event.event_time && `${event.event_time} · `}{event.location && `${event.location}`}
                                            </p>
                                        </div>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No upcoming events.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}