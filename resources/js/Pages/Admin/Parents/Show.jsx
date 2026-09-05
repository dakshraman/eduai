import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { ArrowLeft, Edit } from 'lucide-react';

export default function Show({ parent }) {
    return (
        <AppLayout title={`Parent — ${parent?.name}`}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <Link href={route('admin.parents.index')}>
                        <Button variant="outline"><ArrowLeft className="mr-2 h-4 w-4" /> Back</Button>
                    </Link>
                    <Link href={route('admin.parents.edit', parent?.id)}>
                        <Button><Edit className="mr-2 h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                <Card>
                    <CardHeader><CardTitle className="text-base">Parent Information</CardTitle></CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div>
                                <p className="text-sm text-muted-foreground">Name</p>
                                <p className="font-medium">{parent?.name}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Email</p>
                                <p className="font-medium">{parent?.email}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Phone</p>
                                <p className="font-medium">{parent?.phone}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Relation</p>
                                <Badge variant="secondary">{parent?.relation_type}</Badge>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Occupation</p>
                                <p className="font-medium">{parent?.occupation || '—'}</p>
                            </div>
                            <div>
                                <p className="text-sm text-muted-foreground">Address</p>
                                <p className="font-medium">{parent?.address || '—'}</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader><CardTitle className="text-base">Linked Students</CardTitle></CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Roll Number</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {parent?.students?.map((student) => (
                                    <TableRow key={student.id}>
                                        <TableCell className="font-medium">{student.name}</TableCell>
                                        <TableCell>{student.class?.name}</TableCell>
                                        <TableCell>{student.roll_number}</TableCell>
                                    </TableRow>
                                ))}
                                {(!parent?.students || parent.students.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={3} className="text-center text-muted-foreground">No linked students.</TableCell>
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
