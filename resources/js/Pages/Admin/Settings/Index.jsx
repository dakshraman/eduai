import AppLayout from '@/layouts/AppLayout';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Textarea } from '@/components/ui/textarea';

export default function Index({ settings }) {
    const general = useForm({
        school_name: settings?.school_name || '',
        email: settings?.email || '',
        phone: settings?.phone || '',
        address: settings?.address || '',
        website: settings?.website || '',
    });

    const academic = useForm({
        timezone: settings?.timezone || '',
        currency: settings?.currency || '',
        currency_symbol: settings?.currency_symbol || '',
        date_format: settings?.date_format || 'Y-m-d',
    });

    const system = useForm({
        school_code: settings?.school_code || '',
        slug: settings?.slug || '',
        created_at: settings?.created_at || '',
    });

    const saveGeneral = (e) => {
        e.preventDefault();
        general.put(route('admin.settings.update', 'general'));
    };

    const saveAcademic = (e) => {
        e.preventDefault();
        academic.put(route('admin.settings.update', 'academic'));
    };

    return (
        <AppLayout title="Settings">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Settings</h1>
                    <p className="text-muted-foreground">Configure your school settings.</p>
                </div>

                <Tabs defaultValue="general">
                    <TabsList>
                        <TabsTrigger value="general">General</TabsTrigger>
                        <TabsTrigger value="academic">Academic</TabsTrigger>
                        <TabsTrigger value="system">System</TabsTrigger>
                    </TabsList>

                    <TabsContent value="general">
                        <Card>
                            <CardHeader><CardTitle className="text-base">General Settings</CardTitle></CardHeader>
                            <CardContent>
                                <form onSubmit={saveGeneral} className="space-y-4 max-w-xl">
                                    <div className="space-y-2">
                                        <Label htmlFor="school_name">School Name</Label>
                                        <Input id="school_name" value={general.data.school_name} onChange={(e) => general.setData('school_name', e.target.value)} />
                                    </div>
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="space-y-2">
                                            <Label htmlFor="email">Email</Label>
                                            <Input id="email" type="email" value={general.data.email} onChange={(e) => general.setData('email', e.target.value)} />
                                        </div>
                                        <div className="space-y-2">
                                            <Label htmlFor="phone">Phone</Label>
                                            <Input id="phone" value={general.data.phone} onChange={(e) => general.setData('phone', e.target.value)} />
                                        </div>
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="address">Address</Label>
                                        <Textarea id="address" rows={2} value={general.data.address} onChange={(e) => general.setData('address', e.target.value)} />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="website">Website</Label>
                                        <Input id="website" value={general.data.website} onChange={(e) => general.setData('website', e.target.value)} />
                                    </div>
                                    <Button type="submit" disabled={general.processing}>Save Changes</Button>
                                </form>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    <TabsContent value="academic">
                        <Card>
                            <CardHeader><CardTitle className="text-base">Academic Settings</CardTitle></CardHeader>
                            <CardContent>
                                <form onSubmit={saveAcademic} className="space-y-4 max-w-xl">
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="space-y-2">
                                            <Label htmlFor="timezone">Timezone</Label>
                                            <Input id="timezone" value={academic.data.timezone} onChange={(e) => academic.setData('timezone', e.target.value)} placeholder="UTC" />
                                        </div>
                                        <div className="space-y-2">
                                            <Label htmlFor="date_format">Date Format</Label>
                                            <Input id="date_format" value={academic.data.date_format} onChange={(e) => academic.setData('date_format', e.target.value)} placeholder="Y-m-d" />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="space-y-2">
                                            <Label htmlFor="currency">Currency</Label>
                                            <Input id="currency" value={academic.data.currency} onChange={(e) => academic.setData('currency', e.target.value)} placeholder="USD" />
                                        </div>
                                        <div className="space-y-2">
                                            <Label htmlFor="currency_symbol">Currency Symbol</Label>
                                            <Input id="currency_symbol" value={academic.data.currency_symbol} onChange={(e) => academic.setData('currency_symbol', e.target.value)} placeholder="$" />
                                        </div>
                                    </div>
                                    <Button type="submit" disabled={academic.processing}>Save Changes</Button>
                                </form>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    <TabsContent value="system">
                        <Card>
                            <CardHeader><CardTitle className="text-base">System Information</CardTitle></CardHeader>
                            <CardContent>
                                <div className="space-y-4 max-w-xl">
                                    <div className="space-y-2">
                                        <Label>School Code</Label>
                                        <Input value={system.data.school_code} disabled />
                                    </div>
                                    <div className="space-y-2">
                                        <Label>Slug</Label>
                                        <Input value={system.data.slug} disabled />
                                    </div>
                                    <div className="space-y-2">
                                        <Label>Created At</Label>
                                        <Input value={system.data.created_at} disabled />
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>
                </Tabs>
            </div>
        </AppLayout>
    );
}
