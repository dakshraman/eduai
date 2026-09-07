import AppLayout from '@/layouts/AppLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ArrowLeft } from 'lucide-react';

export default function Create({ plans }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        code: '',
        email: '',
        phone: '',
        address: '',
        timezone: 'UTC',
        currency: 'USD',
        admin_name: '',
        admin_email: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/superadmin/schools');
    };

    return (
        <AppLayout title="Create School">
            <div className="space-y-6">
                <div className="flex items-center gap-3">
                    <Link href="/superadmin/schools">
                        <Button variant="ghost" size="icon"><ArrowLeft className="h-4 w-4" /></Button>
                    </Link>
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Create School</h1>
                        <p className="text-muted-foreground">Onboard a new school to the platform</p>
                    </div>
                </div>

                <Card className="max-w-2xl">
                    <CardHeader>
                        <CardTitle className="text-base">School Information</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-4">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="name">School Name *</Label>
                                    <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="e.g. Greenfield Academy" />
                                    {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="code">School Code *</Label>
                                    <Input id="code" value={data.code} onChange={(e) => setData('code', e.target.value)} placeholder="e.g. GFA" />
                                    {errors.code && <p className="text-sm text-destructive">{errors.code}</p>}
                                </div>
                            </div>
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="email">School Email *</Label>
                                    <Input id="email" type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} />
                                    {errors.email && <p className="text-sm text-destructive">{errors.email}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input id="phone" value={data.phone} onChange={(e) => setData('phone', e.target.value)} />
                                </div>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="address">Address</Label>
                                <Input id="address" value={data.address} onChange={(e) => setData('address', e.target.value)} />
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label>Timezone</Label>
                                    <Select value={data.timezone} onValueChange={(v) => setData('timezone', v)}>
                                        <SelectTrigger><SelectValue /></SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="UTC">UTC</SelectItem>
                                            <SelectItem value="America/New_York">Eastern Time</SelectItem>
                                            <SelectItem value="America/Chicago">Central Time</SelectItem>
                                            <SelectItem value="America/Denver">Mountain Time</SelectItem>
                                            <SelectItem value="America/Los_Angeles">Pacific Time</SelectItem>
                                            <SelectItem value="Europe/London">London</SelectItem>
                                            <SelectItem value="Australia/Sydney">Sydney</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div className="space-y-2">
                                    <Label>Currency</Label>
                                    <Select value={data.currency} onValueChange={(v) => setData('currency', v)}>
                                        <SelectTrigger><SelectValue /></SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="USD">USD ($)</SelectItem>
                                            <SelectItem value="GBP">GBP (£)</SelectItem>
                                            <SelectItem value="EUR">EUR (€)</SelectItem>
                                            <SelectItem value="AUD">AUD (A$)</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>

                            <div className="border-t border-border pt-4 mt-4">
                                <h3 className="text-sm font-medium mb-3">Admin Account</h3>
                                <div className="grid gap-4 md:grid-cols-2">
                                    <div className="space-y-2">
                                        <Label htmlFor="admin_name">Admin Name *</Label>
                                        <Input id="admin_name" value={data.admin_name} onChange={(e) => setData('admin_name', e.target.value)} placeholder="e.g. John Smith" />
                                        {errors.admin_name && <p className="text-sm text-destructive">{errors.admin_name}</p>}
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="admin_email">Admin Email *</Label>
                                        <Input id="admin_email" type="email" value={data.admin_email} onChange={(e) => setData('admin_email', e.target.value)} />
                                        {errors.admin_email && <p className="text-sm text-destructive">{errors.admin_email}</p>}
                                    </div>
                                </div>
                                <p className="text-xs text-muted-foreground mt-2">Default password: <code>password</code></p>
                            </div>

                            <div className="flex gap-2">
                                <Button type="submit" disabled={processing}>Create School</Button>
                                <Link href="/superadmin/schools"><Button variant="outline" type="button">Cancel</Button></Link>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
