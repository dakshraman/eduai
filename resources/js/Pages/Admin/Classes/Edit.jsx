import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { ArrowLeft } from 'lucide-react';

export default function Edit({ cls }) {
    const { data, setData, put, processing, errors } = useForm({
        name: cls.name || '',
        name_numeric: cls.name_numeric || '',
    });

    const submit = (e) => {
        e.preventDefault();
        put(`/classes/${cls.id}`);
    };

    return (
        <AppLayout title={`Edit ${cls.name}`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/classes">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Edit {cls.name}</h1>
                        <p className="text-muted-foreground">Update class details</p>
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
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Update Class</Button>
                                <Link href="/classes"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
