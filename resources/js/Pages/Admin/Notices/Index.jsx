import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Plus } from 'lucide-react';

const typeColors = {
    general: 'bg-blue-100 text-blue-800',
    exam: 'bg-red-100 text-red-800',
    event: 'bg-green-100 text-green-800',
    holiday: 'bg-yellow-100 text-yellow-800',
};

export default function Index({ notices }) {
    return (
        <AppLayout title="Notices">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Notices</h1>
                        <p className="text-muted-foreground">View and manage school notices.</p>
                    </div>
                    <Link href={route('admin.notices.create')}>
                        <Button><Plus className="mr-2 h-4 w-4" /> Add Notice</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {notices?.map((notice) => (
                        <Link key={notice.id} href={route('admin.notices.show', notice.id)}>
                            <Card className="hover:shadow-md transition-shadow cursor-pointer">
                                <CardHeader className="pb-3">
                                    <div className="flex items-center justify-between">
                                        <CardTitle className="text-base">{notice.title}</CardTitle>
                                        <Badge className={typeColors[notice.notice_type] || 'bg-gray-100 text-gray-800'}>
                                            {notice.notice_type}
                                        </Badge>
                                    </div>
                                    <p className="text-xs text-muted-foreground">{notice.published_at || notice.created_at}</p>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-sm text-muted-foreground line-clamp-2">
                                        {notice.message}
                                    </p>
                                </CardContent>
                            </Card>
                        </Link>
                    ))}
                    {(!notices || notices.length === 0) && (
                        <Card className="col-span-full">
                            <CardContent className="py-8 text-center text-muted-foreground">No notices yet.</CardContent>
                        </Card>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
