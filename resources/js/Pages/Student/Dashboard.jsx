import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { ClipboardCheck, FileText, Percent, GraduationCap, ArrowRight, Bell, CalendarDays } from 'lucide-react';

export default function Dashboard({ student, stats, notices, events }) {
    if (!student) {
        return (
            <AppLayout title="Dashboard">
                <Card>
                    <CardContent className="py-12 text-center">
                        <GraduationCap className="h-10 w-10 text-muted-foreground mx-auto mb-4" />
                        <p className="font-medium">No student profile linked to your account.</p>
                        <p className="text-sm text-muted-foreground mt-1">Contact your school administrator.</p>
                    </CardContent>
                </Card>
            </AppLayout>
        );
    }

    const statCards = [
        { title: 'Attendance', value: `${stats.attendancePercentage}%`, icon: ClipboardCheck, color: 'bg-secondary/50' },
        { title: 'Days Present', value: stats.present, icon: ClipboardCheck, color: 'bg-primary/50' },
        { title: 'Exams Taken', value: stats.examsTaken, icon: FileText, color: 'bg-accent/50' },
        { title: 'Average Score', value: `${stats.averagePercentage}%`, icon: Percent, color: 'bg-secondary/50' },
    ];

    return (
        <AppLayout title="Student Dashboard">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Hi, {student.user?.name}!</h1>
                    <p className="text-muted-foreground">
                        {student.class?.name}{student.section?.name ? ` · Section ${student.section.name}` : ''} · Roll {student.roll_number}
                    </p>
                </div>

                {/* Stats */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    {statCards.map((stat, i) => (
                        <Card key={i}>
                            <CardContent className="p-6">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm text-muted-foreground">{stat.title}</p>
                                        <p className="text-2xl font-bold">{stat.value}</p>
                                    </div>
                                    <div className={`h-12 w-12 rounded-lg ${stat.color} flex items-center justify-center`}>
                                        <stat.icon className="h-6 w-6" />
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Quick links */}
                <div className="grid gap-3 sm:grid-cols-3">
                    <Link href="/student/attendance" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                        <span className="flex items-center gap-3">
                            <ClipboardCheck className="h-5 w-5 text-primary" />
                            <span className="font-medium text-sm">My Attendance</span>
                        </span>
                        <ArrowRight className="h-4 w-4 text-muted-foreground" />
                    </Link>
                    <Link href="/student/results" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                        <span className="flex items-center gap-3">
                            <FileText className="h-5 w-5 text-primary" />
                            <span className="font-medium text-sm">My Results</span>
                        </span>
                        <ArrowRight className="h-4 w-4 text-muted-foreground" />
                    </Link>
                    <Link href="/student/fees" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                        <span className="flex items-center gap-3">
                            <Percent className="h-5 w-5 text-primary" />
                            <span className="font-medium text-sm">My Fees</span>
                        </span>
                        <ArrowRight className="h-4 w-4 text-muted-foreground" />
                    </Link>
                </div>

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Notices */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><Bell className="h-4 w-4" /> Recent Notices</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {notices?.length > 0 ? notices.map((notice) => (
                                    <div key={notice.id} className="border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div className="flex items-center justify-between">
                                            <p className="font-medium text-sm">{notice.title}</p>
                                            <Badge variant="secondary">{notice.notice_type}</Badge>
                                        </div>
                                        <p className="text-xs text-muted-foreground mt-1 line-clamp-2">{notice.message}</p>
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
                            <div className="space-y-3">
                                {events?.length > 0 ? events.map((event) => (
                                    <div key={event.id} className="flex gap-4 border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div className="flex flex-col items-center justify-center rounded-lg bg-primary/10 px-3 py-1 min-w-14">
                                            <span className="text-lg font-bold text-primary leading-none">
                                                {new Date(event.event_date).getDate()}
                                            </span>
                                            <span className="text-[10px] uppercase text-muted-foreground">
                                                {new Date(event.event_date).toLocaleString('en', { month: 'short' })}
                                            </span>
                                        </div>
                                        <div>
                                            <p className="font-medium text-sm">{event.title}</p>
                                            <p className="text-xs text-muted-foreground mt-1 line-clamp-1">{event.description}</p>
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