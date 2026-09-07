import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Pencil, ArrowLeft, Calendar, User } from 'lucide-react';

const typeColors = {
    general: 'bg-blue-100 text-blue-800',
    exam: 'bg-red-100 text-red-800',
    event: 'bg-green-100 text-green-800',
    holiday: 'bg-yellow-100 text-yellow-800',
};

export default function Show({ notice }) {
    return (
        <AppLayout title={notice.title}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/notices">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{notice.title}</h1>
                            <p className="text-muted-foreground">Notice details</p>
                        </div>
                    </div>
                    <Link href={`/notices/${notice.id}/edit`}>
                        <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                <Card>
                    <CardHeader>
                        <div className="flex items-center justify-between">
                            <CardTitle className="text-base">{notice.title}</CardTitle>
                            <Badge className={typeColors[notice.notice_type] || 'bg-gray-100 text-gray-800'}>
                                {notice.notice_type}
                            </Badge>
                        </div>
                    </CardHeader>
                    <CardContent className="space-y-4">
                        <div className="flex items-center gap-4 text-sm text-muted-foreground">
                            <span className="flex items-center gap-1">
                                <Calendar className="h-3 w-3" />
                                Published: {notice.published_at || notice.created_at}
                            </span>
                            <span className="flex items-center gap-1">
                                <User className="h-3 w-3" />
                                By: {notice.creator?.name || 'Unknown'}
                            </span>
                        </div>
                        <div className="whitespace-pre-wrap text-sm leading-relaxed">
                            {notice.message}
                        </div>
                        <Badge variant={notice.active_status ? 'default' : 'secondary'}>
                            {notice.active_status ? 'Active' : 'Inactive'}
                        </Badge>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
