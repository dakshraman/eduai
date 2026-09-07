import AppLayout from '@/layouts/AppLayout';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator';

export default function Index({ settings }) {
    const { data, setData, post, processing, errors } = useForm({
        platform_name: settings?.platform_name || 'EduAI',
        support_email: settings?.support_email || '',
        default_trial_days: settings?.default_trial_days || 14,
        stripe_key: settings?.stripe_key || '',
        stripe_secret: settings?.stripe_secret ? '••••••••' : '',
        smtp_host: settings?.smtp_host || '',
        smtp_port: settings?.smtp_port || '587',
        smtp_user: settings?.smtp_user || '',
        smtp_pass: settings?.smtp_pass ? '••••••••' : '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/superadmin/settings');
    };

    return (
        <AppLayout title="Platform Settings">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Platform Settings</h1>
                    <p className="text-muted-foreground">Configure your SaaS platform</p>
                </div>

                <form onSubmit={submit} className="space-y-6 max-w-2xl">
                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">General</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="platform_name">Platform Name</Label>
                                <Input id="platform_name" value={data.platform_name} onChange={(e) => setData('platform_name', e.target.value)} />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="support_email">Support Email</Label>
                                <Input id="support_email" type="email" value={data.support_email} onChange={(e) => setData('support_email', e.target.value)} placeholder="support@example.com" />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="default_trial_days">Default Trial Days</Label>
                                <Input id="default_trial_days" type="number" min="1" max="365" value={data.default_trial_days} onChange={(e) => setData('default_trial_days', parseInt(e.target.value) || 14)} />
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Stripe (Billing)</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="stripe_key">Publishable Key</Label>
                                <Input id="stripe_key" value={data.stripe_key} onChange={(e) => setData('stripe_key', e.target.value)} placeholder="pk_live_..." />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="stripe_secret">Secret Key</Label>
                                <Input id="stripe_secret" type="password" value={data.stripe_secret} onChange={(e) => setData('stripe_secret', e.target.value)} placeholder="sk_live_..." />
                                {settings?.stripe_secret && <p className="text-xs text-muted-foreground">Leave blank to keep existing key.</p>}
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Email (SMTP)</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="smtp_host">SMTP Host</Label>
                                    <Input id="smtp_host" value={data.smtp_host} onChange={(e) => setData('smtp_host', e.target.value)} placeholder="smtp.gmail.com" />
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="smtp_port">SMTP Port</Label>
                                    <Input id="smtp_port" value={data.smtp_port} onChange={(e) => setData('smtp_port', e.target.value)} />
                                </div>
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="smtp_user">SMTP Username</Label>
                                <Input id="smtp_user" value={data.smtp_user} onChange={(e) => setData('smtp_user', e.target.value)} />
                            </div>
                            <div className="space-y-2">
                                <Label htmlFor="smtp_pass">SMTP Password</Label>
                                <Input id="smtp_pass" type="password" value={data.smtp_pass} onChange={(e) => setData('smtp_pass', e.target.value)} />
                                {settings?.smtp_pass && <p className="text-xs text-muted-foreground">Leave blank to keep existing password.</p>}
                            </div>
                        </CardContent>
                    </Card>

                    <div className="flex justify-end">
                        <Button type="submit" disabled={processing}>Save Settings</Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
