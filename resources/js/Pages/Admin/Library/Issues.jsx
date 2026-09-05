import AppLayout from '@/layouts/AppLayout';
import { router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft } from 'lucide-react';

const statusColors = {
    issued: 'bg-blue-100 text-blue-800',
    returned: 'bg-green-100 text-green-800',
    overdue: 'bg-red-100 text-red-800',
};

export default function Issues({ issues }) {
    const handleReturn = (id) => {
        if (confirm('Mark as returned?')) {
            router.post(route('admin.library.issues.return', id));
        }
    };

    return (
        <AppLayout title="Book Issues">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Book Issues</h1>
                        <p className="text-muted-foreground">Track issued books and returns.</p>
                    </div>
                    <Button variant="outline" onClick={() => router.visit(route('admin.library.index'))}>
                        <ArrowLeft className="mr-2 h-4 w-4" /> Back to Library
                    </Button>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Book</TableHead>
                                    <TableHead>Student</TableHead>
                                    <TableHead>Issue Date</TableHead>
                                    <TableHead>Due Date</TableHead>
                                    <TableHead>Return Date</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Fine</TableHead>
                                    <TableHead className="w-[80px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {issues?.map((issue) => (
                                    <TableRow key={issue.id}>
                                        <TableCell className="font-medium">{issue.book?.title}</TableCell>
                                        <TableCell>{issue.student?.name}</TableCell>
                                        <TableCell>{issue.issue_date}</TableCell>
                                        <TableCell>{issue.due_date}</TableCell>
                                        <TableCell>{issue.return_date || '—'}</TableCell>
                                        <TableCell>
                                            <Badge className={statusColors[issue.status] || 'bg-gray-100 text-gray-800'}>
                                                {issue.status}
                                            </Badge>
                                        </TableCell>
                                        <TableCell>{issue.fine || '—'}</TableCell>
                                        <TableCell>
                                            {issue.status !== 'returned' && (
                                                <Button variant="outline" size="sm" onClick={() => handleReturn(issue.id)}>
                                                    Return
                                                </Button>
                                            )}
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!issues || issues.length === 0) && (
                                    <TableRow><TableCell colSpan={8} className="text-center text-muted-foreground">No issues yet.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
