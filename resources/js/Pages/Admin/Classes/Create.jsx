import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { ArrowLeft } from 'lucide-react';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        name_numeric: '',
        section_count: 1,
    });

    const submit = (e) => {
        e.preventDefault();
        post('/classes');
    };

    return (
        <AppLayout title="Create Class">
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/classes">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Create Class</h1>
                        <p className="text-muted-foreground">Add a new class to the system</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Class Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Class Name</Label>
                                <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="e.g. Grade 10" />
                                {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="name_numeric">Numeric Name</Label>
                                <Input id="name_numeric" type="number" value={data.name_numeric} onChange={(e) => setData('name_numeric', e.target.value)} placeholder="e.g. 10" />
                                {errors.name_numeric && <p className="text-sm text-destructive">{errors.name_numeric}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="section_count">Number of Sections</Label>
                                <Input id="section_count" type="number" min="1" value={data.section_count} onChange={(e) => setData('section_count', parseInt(e.target.value) || 1)} />
                                {errors.section_count && <p className="text-sm text-destructive">{errors.section_count}</p>}
                            </div>
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Create Class</Button>
                                <Link href="/classes"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
