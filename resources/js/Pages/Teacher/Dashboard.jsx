import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { BookOpen, Users, FileText, ClipboardCheck, ArrowRight, CalendarDays, Bell } from 'lucide-react';

export default function Dashboard({ stats, teacher, classes, upcomingExams, notices }) {
    const statCards = [
        { title: 'Classes', value: stats.classes, icon: BookOpen, color: 'bg-secondary/50' },
        { title: 'Students', value: stats.students, icon: Users, color: 'bg-primary/50' },
        { title: 'Exams', value: stats.exams, icon: FileText, color: 'bg-accent/50' },
        { title: 'Attendance Marked Today', value: stats.todayAttendance, icon: ClipboardCheck, color: 'bg-secondary/50' },
    ];

    return (
        <AppLayout title="Teacher Dashboard">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Welcome, {teacher?.user?.name ?? 'Teacher'}!</h1>
                    <p className="text-muted-foreground">
                        {teacher?.designation ? `${teacher.designation} · ` : ''}Here's your teaching overview.
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

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Quick actions */}
                    <Card>
                        <CardHeader><CardTitle className="text-base">Quick Actions</CardTitle></CardHeader>
                        <CardContent className="grid gap-3 sm:grid-cols-2">
                            <Link href="/teacher/attendance" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                                <span className="flex items-center gap-3">
                                    <ClipboardCheck className="h-5 w-5 text-primary" />
                                    <span className="font-medium text-sm">Mark Attendance</span>
                                </span>
                                <ArrowRight className="h-4 w-4 text-muted-foreground" />
                            </Link>
                            <Link href="/teacher/exams" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                                <span className="flex items-center gap-3">
                                    <FileText className="h-5 w-5 text-primary" />
                                    <span className="font-medium text-sm">Enter Exam Results</span>
                                </span>
                                <ArrowRight className="h-4 w-4 text-muted-foreground" />
                            </Link>
                            <Link href="/teacher/notices" className="flex items-center justify-between rounded-xl border border-border p-4 hover:bg-accent/40 transition-colors">
                                <span className="flex items-center gap-3">
                                    <Bell className="h-5 w-5 text-primary" />
                                    <span className="font-medium text-sm">View Notices</span>
                                </span>
                                <ArrowRight className="h-4 w-4 text-muted-foreground" />
                            </Link>
                        </CardContent>
                    </Card>

                    {/* Upcoming exams */}
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><CalendarDays className="h-4 w-4" /> Upcoming Exams</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {upcomingExams?.length > 0 ? upcomingExams.map((exam) => (
                                    <div key={exam.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{exam.name}</p>
                                            <p className="text-xs text-muted-foreground">{exam.class?.name} · {exam.start_date} → {exam.end_date}</p>
                                        </div>
                                        <Badge variant="secondary">{exam.exam_type}</Badge>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No upcoming exams.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Recent notices */}
                {notices?.length > 0 && (
                    <Card>
                        <CardHeader><CardTitle className="text-base flex items-center gap-2"><Bell className="h-4 w-4" /> Recent Notices</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {notices.map((notice) => (
                                    <div key={notice.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{notice.title}</p>
                                            <p className="text-xs text-muted-foreground line-clamp-1">{notice.message}</p>
                                        </div>
                                        <Badge variant="secondary">{notice.notice_type}</Badge>
                                    </div>
                                ))}
                            </div>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}