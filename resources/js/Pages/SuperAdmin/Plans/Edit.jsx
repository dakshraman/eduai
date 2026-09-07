import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft } from 'lucide-react';

export default function Edit({ plan }) {
    const { data, setData, put, processing, errors } = useForm({
        name: plan.name || '',
        description: plan.description || '',
        price_monthly: plan.price_monthly || '',
        price_yearly: plan.price_yearly || '',
        features: plan.features?.length > 0 ? plan.features : [''],
        active_status: plan.active_status ?? true,
    });

    const addFeature = () => setData('features', [...data.features, '']);
    const removeFeature = (i) => setData('features', data.features.filter((_, idx) => idx !== i));
    const updateFeature = (i, val) => {
        const updated = [...data.features];
        updated[i] = val;
        setData('features', updated);
    };

    const submit = (e) => {
        e.preventDefault();
        put(`/superadmin/plans/${plan.id}`);
    };

    return (
        <AppLayout title={`Edit ${plan.name}`}>
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/superadmin/plans">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Edit {plan.name}</h1>
                        <p className="text-muted-foreground">Update subscription plan</p>
                    </div>
                </div>

                <Card className="max-w-lg">
                    <CardHeader>
                        <CardTitle className="text-base">Plan Details</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Plan Name *</Label>
                                <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                                {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="description">Description</Label>
                                <Textarea id="description" rows={2} value={data.description} onChange={(e) => setData('description', e.target.value)} />
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="price_monthly">Monthly Price ($) *</Label>
                                    <Input id="price_monthly" type="number" step="0.01" value={data.price_monthly} onChange={(e) => setData('price_monthly', e.target.value)} />
                                    {errors.price_monthly && <p className="text-sm text-destructive">{errors.price_monthly}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="price_yearly">Yearly Price ($)</Label>
                                    <Input id="price_yearly" type="number" step="0.01" value={data.price_yearly} onChange={(e) => setData('price_yearly', e.target.value)} />
                                </div>
                            </div>
                            <div className="space-y-2">
                                <Label>Features</Label>
                                {data.features.map((feature, i) => (
                                    <div key={i} className="flex gap-2">
                                        <Input value={feature} onChange={(e) => updateFeature(i, e.target.value)} placeholder="e.g. Up to 100 students" />
                                        {data.features.length > 1 && (
                                            <Button type="button" variant="ghost" size="sm" onClick={() => removeFeature(i)}>Remove</Button>
                                        )}
                                    </div>
                                ))}
                                <Button type="button" variant="outline" size="sm" onClick={addFeature}>+ Add Feature</Button>
                            </div>
                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Update Plan</Button>
                                <Link href="/superadmin/plans"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
