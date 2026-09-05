import AppLayout from '@/layouts/AppLayout';
import { useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Trash2 } from 'lucide-react';

export default function Structures({ structures, categories, classes }) {
    const { data, setData, post, processing, reset } = useForm({
        name: '',
        amount: '',
        category_id: '',
        class_id: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.fees.structures.store'), { onSuccess: () => reset() });
    };

    const handleDelete = (id) => {
        if (confirm('Delete this structure?')) {
            router.delete(route('admin.fees.structures.destroy', id));
        }
    };

    return (
        <AppLayout title="Fee Structures">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Fee Structures</h1>
                    <p className="text-muted-foreground">Define fee structures by class and category.</p>
                </div>

                <Card>
                    <CardHeader><CardTitle className="text-base">Add Structure</CardTitle></CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Name</Label>
                                <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="e.g. First Term Tuition" />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="amount">Amount</Label>
                                <Input id="amount" type="number" value={data.amount} onChange={(e) => setData('amount', e.target.value)} placeholder="0.00" />
                            </div>
                            <div className="space-y-2">
                                <Label>Category</Label>
                                <Select value={data.category_id} onValueChange={(v) => setData('category_id', v)}>
                                    <SelectTrigger><SelectValue placeholder="Select category" /></SelectTrigger>
                                    <SelectContent>
                                        {categories?.map((cat) => (
                                            <SelectItem key={cat.id} value={String(cat.id)}>{cat.name}</SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="space-y-2">
                                <Label>Class</Label>
                                <Select value={data.class_id} onValueChange={(v) => setData('class_id', v)}>
                                    <SelectTrigger><SelectValue placeholder="Select class" /></SelectTrigger>
                                    <SelectContent>
                                        {classes?.map((cls) => (
                                            <SelectItem key={cls.id} value={String(cls.id)}>{cls.name}</SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="md:col-span-2 lg:col-span-4">
                                <Button type="submit" disabled={processing}>Add Structure</Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader><CardTitle className="text-base">Structures</CardTitle></CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>#</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Category</TableHead>
                                    <TableHead>Class</TableHead>
                                    <TableHead>Amount</TableHead>
                                    <TableHead className="w-[80px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {structures?.map((s, i) => (
                                    <TableRow key={s.id}>
                                        <TableCell>{i + 1}</TableCell>
                                        <TableCell className="font-medium">{s.name}</TableCell>
                                        <TableCell>{s.category?.name}</TableCell>
                                        <TableCell>{s.class?.name}</TableCell>
                                        <TableCell>{s.amount}</TableCell>
                                        <TableCell>
                                            <Button variant="ghost" size="icon" onClick={() => handleDelete(s.id)}>
                                                <Trash2 className="h-4 w-4 text-destructive" />
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!structures || structures.length === 0) && (
                                    <TableRow>
                                        <TableCell colSpan={6} className="text-center text-muted-foreground">No structures yet.</TableCell>
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
