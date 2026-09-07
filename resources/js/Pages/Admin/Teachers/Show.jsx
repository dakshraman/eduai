import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Pencil, ArrowLeft, Mail, Phone, Building, Calendar } from 'lucide-react';

export default function Show({ teacher }) {
    return (
        <AppLayout title={teacher.user?.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/teachers">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{teacher.user?.name}</h1>
                            <p className="text-muted-foreground">Teacher profile</p>
                        </div>
                    </div>
                    <Link href={`/teachers/${teacher.id}/edit`}>
                        <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                <div className="grid gap-6 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Personal Information</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <div className="flex items-center gap-3">
                                <Mail className="h-4 w-4 text-muted-foreground" />
                                <span>{teacher.user?.email}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <Phone className="h-4 w-4 text-muted-foreground" />
                                <span>{teacher.user?.phone || 'Not provided'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Gender:</span>
                                <span className="capitalize">{teacher.user?.gender || 'Not provided'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Address:</span>
                                <span>{teacher.user?.address || 'Not provided'}</span>
                            </div>
                            <Badge variant={teacher.active_status ? 'default' : 'secondary'}>
                                {teacher.active_status ? 'Active' : 'Inactive'}
                            </Badge>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Professional Information</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Employee ID:</span>
                                <span className="font-medium">{teacher.employee_id}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <Building className="h-4 w-4 text-muted-foreground" />
                                <span>{teacher.designation || 'Not assigned'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Department:</span>
                                <span>{teacher.department || 'Not assigned'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <Calendar className="h-4 w-4 text-muted-foreground" />
                                <span>Joined: {teacher.joining_date || 'Not set'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Salary:</span>
                                <span>{teacher.salary ? `$${Number(teacher.salary).toLocaleString()}` : 'Not set'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Qualification:</span>
                                <span>{teacher.qualification || 'Not provided'}</span>
                            </div>
                            <div className="flex items-center gap-3">
                                <span className="text-muted-foreground">Experience:</span>
                                <span>{teacher.experience ? `${teacher.experience} years` : 'Not provided'}</span>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
