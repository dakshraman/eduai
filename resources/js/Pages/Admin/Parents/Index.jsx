import AppLayout from '@/layouts/AppLayout';
import { Link, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Plus, Eye, Edit, Trash2 } from 'lucide-react';

export default function Index({ parents }) {
    const handleDelete = (id) => {
        if (confirm('Delete this parent?')) {
            router.delete(route('admin.parents.destroy', id));
        }
    };

    return (
        <AppLayout title="Parents">
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Parents</h1>
                        <p className="text-muted-foreground">Manage parent accounts.</p>
                    </div>
                    <Link href={route('admin.parents.create')}>
                        <Button><Plus className="mr-2 h-4 w-4" /> Add Parent</Button>
                    </Link>
                </div>

                <Card>
                    <CardContent className="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Phone</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Relation</TableHead>
                                    <TableHead>Students</TableHead>
                                    <TableHead className="w-[120px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {parents?.map((parent) => (
                                    <TableRow key={parent.id}>
                                        <TableCell className="font-medium">{parent.name}</TableCell>
                                        <TableCell>{parent.phone}</TableCell>
                                        <TableCell>{parent.email}</TableCell>
                                        <TableCell>
                                            <Badge variant="secondary">{parent.relation_type}</Badge>
                                        </TableCell>
                                        <TableCell>{parent.students_count || parent.students?.length || 0}</TableCell>
                                        <TableCell>
                                            <div className="flex items-center gap-1">
                                                <Link href={route('admin.parents.show', parent.id)}>
                                                    <Button variant="ghost" size="icon"><Eye className="h-4 w-4" /></Button>
                                                </Link>
                                                <Link href={route('admin.parents.edit', parent.id)}>
                                                    <Button variant="ghost" size="icon"><Edit className="h-4 w-4" /></Button>
                                                </Link>
                                                <Button variant="ghost" size="icon" onClick={() => handleDelete(parent.id)}>
                                                    <Trash2 className="h-4 w-4 text-destructive" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!parents || parents.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={6} className="text-center text-muted-foreground">No parents yet.</TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
