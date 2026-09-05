import AppLayout from '@/layouts/AppLayout';
import { router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Check } from 'lucide-react';

const plans = [
    {
        name: 'Basic',
        price: '$29/mo',
        features: ['Up to 100 students', '5 admin users', 'Basic reports', 'Email support'],
    },
    {
        name: 'Pro',
        price: '$79/mo',
        features: ['Up to 500 students', '25 admin users', 'Advanced reports', 'Priority support', 'Transport module', 'Library module'],
        popular: true,
    },
    {
        name: 'Enterprise',
        price: '$199/mo',
        features: ['Unlimited students', 'Unlimited users', 'Custom reports', 'Dedicated support', 'All modules', 'API access', 'Custom branding'],
    },
];

export default function Index({ subscription }) {
    const handleSelect = (plan) => {
        if (confirm(`Subscribe to ${plan}?`)) {
            router.post(route('admin.billing.subscribe'), { plan: plan.toLowerCase() });
        }
    };

    return (
        <AppLayout title="Billing">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Billing & Subscription</h1>
                    <p className="text-muted-foreground">Manage your subscription plan.</p>
                </div>

                {subscription && (
                    <Card>
                        <CardHeader><CardTitle className="text-base">Current Subscription</CardTitle></CardHeader>
                        <CardContent>
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-lg font-semibold">{subscription.plan || 'Free'}</p>
                                    <p className="text-sm text-muted-foreground">
                                        Status: <Badge variant={subscription.status === 'active' ? 'default' : 'secondary'}>{subscription.status || 'inactive'}</Badge>
                                    </p>
                                    {subscription.next_billing_date && (
                                        <p className="text-sm text-muted-foreground mt-1">Next billing: {subscription.next_billing_date}</p>
                                    )}
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                )}

                <div className="grid gap-6 md:grid-cols-3">
                    {plans.map((plan) => (
                        <Card key={plan.name} className={plan.popular ? 'border-primary shadow-md' : ''}>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <CardTitle className="text-lg">{plan.name}</CardTitle>
                                    {plan.popular && <Badge>Popular</Badge>}
                                </div>
                                <p className="text-2xl font-bold">{plan.price}</p>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <ul className="space-y-2">
                                    {plan.features.map((f, i) => (
                                        <li key={i} className="flex items-center text-sm">
                                            <Check className="mr-2 h-4 w-4 text-green-600" /> {f}
                                        </li>
                                    ))}
                                </ul>
                                <Button
                                    className="w-full"
                                    variant={subscription?.plan?.toLowerCase() === plan.name.toLowerCase() ? 'outline' : 'default'}
                                    onClick={() => handleSelect(plan.name)}
                                    disabled={subscription?.plan?.toLowerCase() === plan.name.toLowerCase()}
                                >
                                    {subscription?.plan?.toLowerCase() === plan.name.toLowerCase() ? 'Current Plan' : 'Select Plan'}
                                </Button>
                            </CardContent>
                        </Card>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
