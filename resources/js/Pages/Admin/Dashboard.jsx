import AppLayout from '@/layouts/AppLayout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Users, GraduationCap, BookOpen, Bell } from 'lucide-react';

export default function Dashboard({ stats, enrollmentData, feeData, attendanceData, classData, notices }) {
    const statCards = [
        { title: 'Total Students', value: stats.students, icon: Users, color: 'bg-secondary/50' },
        { title: 'Total Teachers', value: stats.teachers, icon: GraduationCap, color: 'bg-primary/50' },
        { title: 'Total Classes', value: stats.classes, icon: BookOpen, color: 'bg-accent/50' },
        { title: 'Total Notices', value: stats.notices, icon: Bell, color: 'bg-secondary/50' },
    ];

    return (
        <AppLayout title="Dashboard">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Dashboard</h1>
                    <p className="text-muted-foreground">Welcome back! Here's your school overview.</p>
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

                {/* Charts placeholder */}
                <div className="grid gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader><CardTitle className="text-base">Enrollment Trend</CardTitle></CardHeader>
                        <CardContent>
                            <div className="h-64 flex items-center justify-center text-muted-foreground text-sm">
                                Chart: Enrollment data (last 6 months)
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader><CardTitle className="text-base">Fee Collection</CardTitle></CardHeader>
                        <CardContent>
                            <div className="h-64 flex items-center justify-center text-muted-foreground text-sm">
                                Chart: Fee collection (last 6 months)
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Recent Notices */}
                {notices && notices.length > 0 && (
                    <Card>
                        <CardHeader><CardTitle className="text-base">Recent Notices</CardTitle></CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {notices.map((notice) => (
                                    <div key={notice.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{notice.title}</p>
                                            <p className="text-xs text-muted-foreground">{notice.notice_type}</p>
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
