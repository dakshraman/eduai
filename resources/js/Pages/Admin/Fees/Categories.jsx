import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Trash2 } from 'lucide-react';

export default function Categories({ categories }) {
    const { data, setData, post, processing, reset } = useForm({ name: '' });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.fees.categories.store'), { onSuccess: () => reset() });
    };

    const handleDelete = (id) => {
        if (confirm('Delete this category?')) {
            router.delete(route('admin.fees.categories.destroy', id));
        }
    };

    return (
        <AppLayout title="Fee Categories">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Fee Categories</h1>
                    <p className="text-muted-foreground">Manage fee categories for your school.</p>
                </div>

                <Card>
                    <CardHeader><CardTitle className="text-base">Add Category</CardTitle></CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="flex items-end gap-4">
                            <div className="flex-1 space-y-2">
                                <Label htmlFor="name">Category Name</Label>
                                <Input
                                    id="name"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    placeholder="e.g. Tuition, Transport, Library"
                                />
                            </div>
                            <Button type="submit" disabled={processing}>Add</Button>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader><CardTitle className="text-base">Categories</CardTitle></CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>#</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead className="w-[80px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {categories?.map((cat, i) => (
                                    <TableRow key={cat.id}>
                                        <TableCell>{i + 1}</TableCell>
                                        <TableCell className="font-medium">{cat.name}</TableCell>
                                        <TableCell>
                                            <Button variant="ghost" size="icon" onClick={() => handleDelete(cat.id)}>
                                                <Trash2 className="h-4 w-4 text-destructive" />
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!categories || categories.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={3} className="text-center text-muted-foreground">No categories yet.</TableCell>
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
