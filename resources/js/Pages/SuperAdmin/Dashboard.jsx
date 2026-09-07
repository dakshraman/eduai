import AppLayout from '@/layouts/AppLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Building2, Users, CreditCard, Timer, DollarSign } from 'lucide-react';

const STATUS_STYLES = {
    active: 'bg-emerald-100 text-emerald-700',
    trial: 'bg-blue-100 text-blue-700',
    expired: 'bg-red-100 text-red-700',
    cancelled: 'bg-gray-100 text-gray-600',
};

export default function Dashboard({ stats, revenue, schools, plans }) {
    const statCards = [
        { title: 'Total Schools', value: stats.schools, icon: Building2, color: 'bg-secondary/50' },
        { title: 'Total Users', value: stats.users, icon: Users, color: 'bg-primary/50' },
        { title: 'Active Subscriptions', value: stats.activeSubscriptions, icon: CreditCard, color: 'bg-accent/50' },
        { title: 'Trial Schools', value: stats.trialSchools, icon: Timer, color: 'bg-secondary/50' },
    ];

    return (
        <AppLayout title="Superadmin Dashboard">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Platform Overview</h1>
                    <p className="text-muted-foreground">Welcome back! Here's the state of your SaaS platform.</p>
                </div>

                {/* Stats */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    {statCards.map((stat, i) => (
                        <Card key={i}>
                            <CardContent className="p-6">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm text-muted-foreground">{stat.title}</p>
                                        <p className="text-2xl font-bold">{stat.value}</p>
                                    </div>
                                    <div className={`h-12 w-12 rounded-lg ${stat.color} flex items-center justify-center`}>
                                        <stat.icon className="h-6 w-6" />
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* MRR Banner */}
                <Card className="border-primary/30">
                    <CardContent className="p-6 flex items-center gap-4">
                        <div className="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center">
                            <DollarSign className="h-6 w-6 text-primary" />
                        </div>
                        <div>
                            <p className="text-sm text-muted-foreground">Monthly Recurring Revenue (active plans)</p>
                            <p className="text-3xl font-extrabold">${revenue.toLocaleString()}</p>
                        </div>
                    </CardContent>
                </Card>

                <div className="grid gap-4 lg:grid-cols-2">
                    {/* Recent Schools */}
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between">
                            <CardTitle className="text-base">Recent Schools</CardTitle>
                            <Link href="/superadmin/schools" className="text-sm text-primary hover:underline">View all</Link>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {schools?.length > 0 ? schools.map((school) => (
                                    <div key={school.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{school.name}</p>
                                            <p className="text-xs text-muted-foreground">
                                                {school.users_count} users · {school.subscription?.plan?.name ?? 'No plan'}
                                            </p>
                                        </div>
                                        <Badge className={STATUS_STYLES[school.subscription?.status] || 'bg-gray-100 text-gray-600'}>
                                            {school.subscription?.status ?? 'no-subscription'}
                                        </Badge>
                                    </div>
                                )) : (
                                    <p className="text-sm text-muted-foreground py-4 text-center">No schools yet.</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Plans */}
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between">
                            <CardTitle className="text-base">Subscription Plans</CardTitle>
                            <Link href="/superadmin/plans" className="text-sm text-primary hover:underline">Manage</Link>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {plans?.map((plan) => (
                                    <div key={plan.id} className="flex items-center justify-between border-b border-border pb-3 last:border-0 last:pb-0">
                                        <div>
                                            <p className="font-medium text-sm">{plan.name}</p>
                                            <p className="text-xs text-muted-foreground">${plan.price_monthly}/mo · {plan.subscriptions_count} subscribers</p>
                                        </div>
                                        <Badge variant={plan.active_status ? 'secondary' : 'outline'}>
                                            {plan.active_status ? 'Active' : 'Inactive'}
                                        </Badge>
                                    </div>
                                ))}
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}