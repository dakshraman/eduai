import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Plus, BookOpen, Users, Hash } from 'lucide-react';

export default function Index({ classes }) {
    return (
        <AppLayout title="Classes">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Classes</h1>
                        <p className="text-muted-foreground">Manage school classes</p>
                    </div>
                    <Link href="/classes/create">
                        <Button className="gap-2"><Plus className="h-4 w-4" /> Add Class</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {classes?.length > 0 ? classes.map((cls) => (
                        <Link key={cls.id} href={`/classes/${cls.id}`}>
                            <Card className="hover:bg-accent/50 transition-colors cursor-pointer">
                                <CardHeader className="pb-3">
                                    <CardTitle className="flex items-center gap-2">
                                        <BookOpen className="h-5 w-5 text-primary" />
                                        {cls.name}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="flex items-center gap-4 text-sm text-muted-foreground">
                                        <div className="flex items-center gap-1">
                                            <Hash className="h-4 w-4" />
                                            {cls.sections_count ?? 0} Sections
                                        </div>
                                        <div className="flex items-center gap-1">
                                            <Users className="h-4 w-4" />
                                            {cls.students_count ?? 0} Students
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </Link>
                    )) : (
                        <Card className="col-span-full">
                            <CardContent className="py-8 text-center text-muted-foreground">
                                No classes found. Create your first class to get started.
                            </CardContent>
                        </Card>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
