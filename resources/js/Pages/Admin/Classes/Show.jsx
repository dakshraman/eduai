import AppLayout from '@/layouts/AppLayout';
import { Link, useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Pencil, Trash2, ArrowLeft } from 'lucide-react';

export default function Show({ cls }) {
    const { data, setData, post, processing, errors } = useForm({ name: '' });

    const addSection = (e) => {
        e.preventDefault();
        post(`/classes/${cls.id}/sections`, { onSuccess: () => setData('name', '') });
    };

    const deleteSection = (sectionId) => {
        if (confirm('Delete this section?')) {
            router.delete(`/classes/${cls.id}/sections/${sectionId}`);
        }
    };

    return (
        <AppLayout title={cls.name}>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <Link href="/classes">
                            <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">{cls.name}</h1>
                            <p className="text-muted-foreground">{cls.sections?.length ?? 0} sections</p>
                        </div>
                    </div>
                    <Link href={`/classes/${cls.id}/edit`}>
                        <Button variant="outline" className="gap-2"><Pencil className="h-4 w-4" /> Edit</Button>
                    </Link>
                </div>

                {/* Sections Table */}
                <Card>
                    <CardHeader>
                        <CardTitle className="text-base">Sections</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Students</TableHead>
                                    <TableHead className="text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {cls.sections?.length > 0 ? cls.sections.map((section) => (
                                    <TableRow key={section.id}>
                                        <TableCell className="font-medium">{section.name}</TableCell>
                                        <TableCell>{section.students_count ?? 0}</TableCell>
                                        <TableCell className="text-right">
                                            <Button variant="ghost" size="icon" className="text-destructive" onClick={() => deleteSection(section.id)}>
                                                <Trash2 className="h-4 w-4" />
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow><TableCell colSpan={3} className="text-center py-4 text-muted-foreground">No sections yet.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>

                        {/* Add Section Form */}
                        <form onSubmit={addSection} className="mt-4 flex items-center gap-2">
                            <Input
                                placeholder="New section name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                className="max-w-xs"
                            />
                            <Button type="submit" disabled={processing}>Add Section</Button>
                        </form>
                        {errors.name && <p className="text-sm text-destructive mt-1">{errors.name}</p>}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
