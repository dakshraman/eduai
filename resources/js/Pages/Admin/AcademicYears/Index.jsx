import AppLayout from '@/layouts/AppLayout';
import { useForm, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Trash2, CheckCircle } from 'lucide-react';

export default function Index({ years }) {
    const { data, setData, post, processing, reset } = useForm({
        year: '',
        title: '',
        start_date: '',
        end_date: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin.academic-years.store'), { onSuccess: () => reset() });
    };

    const handleActivate = (id) => {
        router.post(route('admin.academic-years.activate', id));
    };

    const handleDelete = (id) => {
        if (confirm('Delete this academic year?')) {
            router.delete(route('admin.academic-years.destroy', id));
        }
    };

    return (
        <AppLayout title="Academic Years">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Academic Years</h1>
                    <p className="text-muted-foreground">Manage academic year sessions.</p>
                </div>

                <Card>
                    <CardHeader><CardTitle className="text-base">Add Academic Year</CardTitle></CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="grid gap-4 md:grid-cols-2 lg:grid-cols-5">
                            <div className="space-y-2">
                                <Label htmlFor="year">Year</Label>
                                <Input id="year" value={data.year} onChange={(e) => setData('year', e.target.value)} placeholder="2025-2026" />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="title">Title</Label>
                                <Input id="title" value={data.title} onChange={(e) => setData('title', e.target.value)} placeholder="Session 2025-26" />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="start_date">Start Date</Label>
                                <Input id="start_date" type="date" value={data.start_date} onChange={(e) => setData('start_date', e.target.value)} />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="end_date">End Date</Label>
                                <Input id="end_date" type="date" value={data.end_date} onChange={(e) => setData('end_date', e.target.value)} />
                            </div>
                            <div className="flex items-end">
                                <Button type="submit" disabled={processing} className="w-full">Add Year</Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader><CardTitle className="text-base">Academic Years</CardTitle></CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Year</TableHead>
                                    <TableHead>Title</TableHead>
                                    <TableHead>Start</TableHead>
                                    <TableHead>End</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="w-[120px]">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {years?.map((year) => (
                                    <TableRow key={year.id}>
                                        <TableCell className="font-medium">{year.year}</TableCell>
                                        <TableCell>{year.title}</TableCell>
                                        <TableCell>{year.start_date}</TableCell>
                                        <TableCell>{year.end_date}</TableCell>
                                        <TableCell>
                                            <Badge variant={year.is_active ? 'default' : 'secondary'}>
                                                {year.is_active ? 'Active' : 'Inactive'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell>
                                            <div className="flex items-center gap-1">
                                                {!year.is_active && (
                                                    <Button variant="ghost" size="icon" onClick={() => handleActivate(year.id)} title="Activate">
                                                        <CheckCircle className="h-4 w-4 text-green-600" />
                                                    </Button>
                                                )}
                                                <Button variant="ghost" size="icon" onClick={() => handleDelete(year.id)}>
                                                    <Trash2 className="h-4 w-4 text-destructive" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {(!years || years.length === 0) && (
                                    <TableRow><TableCell colSpan={6} className="text-center text-muted-foreground">No academic years yet.</TableCell></TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
