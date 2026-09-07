import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { UserCheck, ArrowRight, GraduationCap, ClipboardCheck } from 'lucide-react';

export default function Dashboard({ parent, children }) {
    if (!parent) {
        return (
            <AppLayout title="Dashboard">
                <Card>
                    <CardContent className="py-12 text-center">
                        <UserCheck className="h-10 w-10 text-muted-foreground mx-auto mb-4" />
                        <p className="font-medium">No parent profile linked to your account.</p>
                        <p className="text-sm text-muted-foreground mt-1">Contact your school administrator to link your children.</p>
                    </CardContent>
                </Card>
            </AppLayout>
        );
    }

    return (
        <AppLayout title="Parent Dashboard">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Welcome, {parent.user?.name}!</h1>
                    <p className="text-muted-foreground">Here are your children's overviews</p>
                </div>

                {children?.length > 0 ? (
                    <div className="grid gap-4 md:grid-cols-2">
                        {children.map((child) => (
                            <Card key={child.id} className="hover:border-primary/40 transition-colors">
                                <CardHeader className="flex flex-row items-center justify-between">
                                    <div className="flex items-center gap-3">
                                        <div className="h-10 w-10 rounded-full bg-primary/15 flex items-center justify-center">
                                            <GraduationCap className="h-5 w-5 text-primary" />
                                        </div>
                                        <div>
                                            <CardTitle className="text-base">{child.name}</CardTitle>
                                            <p className="text-xs text-muted-foreground">
                                                {child.class}{child.section ? ` · Section ${child.section}` : ''}
                                                {child.roll_number ? ` · Roll ${child.roll_number}` : ''}
                                            </p>
                                        </div>
                                    </div>
                                    <Badge variant="secondary">
                                        <ClipboardCheck className="h-3 w-3 mr-1" />
                                        {child.attendancePercentage}% attendance
                                    </Badge>
                                </CardHeader>
                                <CardContent>
                                    <div className="flex flex-wrap gap-2">
                                        <Button variant="outline" size="sm" asChild>
                                            <Link href={`/parent/children/${child.id}`}>Overview</Link>
                                        </Button>
                                        <Button variant="outline" size="sm" asChild>
                                            <Link href={`/parent/children/${child.id}/attendance`}>Attendance</Link>
                                        </Button>
                                        <Button variant="outline" size="sm" asChild>
                                            <Link href={`/parent/children/${child.id}/results`}>Results</Link>
                                        </Button>
                                        <Button variant="outline" size="sm" asChild>
                                            <Link href={`/parent/children/${child.id}/fees`}>Fees</Link>
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                ) : (
                    <Card>
                        <CardContent className="py-12 text-center">
                            <p className="font-medium">No children linked to your account.</p>
                            <p className="text-sm text-muted-foreground mt-1">Ask the school to link your children to your profile.</p>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}