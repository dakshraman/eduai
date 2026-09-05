import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { 
    Users, ClipboardCheck, DollarSign, FileText, BookOpen, 
    Bell, GraduationCap, BarChart3, Shield, ArrowRight, Check,
    Star
} from 'lucide-react';

const features = [
    { icon: Users, title: 'Student Management', description: 'Complete student profiles with enrollment, class assignment, and admission tracking.', color: 'bg-secondary/50' },
    { icon: ClipboardCheck, title: 'Attendance Tracking', description: 'Quick daily attendance with class-wise marking and parent notifications.', color: 'bg-primary/50' },
    { icon: DollarSign, title: 'Fee Management', description: 'Flexible fee structures, online payments, and automated receipts.', color: 'bg-accent/50' },
    { icon: FileText, title: 'Exams & Results', description: 'Create exams, enter marks, generate report cards, and analyze performance.', color: 'bg-secondary/50' },
    { icon: BookOpen, title: 'Class & Section', description: 'Organize classes, sections, subjects, and teacher assignments.', color: 'bg-primary/50' },
    { icon: Bell, title: 'Notices & Events', description: 'Send notices, manage school events, and holiday calendars.', color: 'bg-accent/50' },
    { icon: GraduationCap, title: 'Teacher Portal', description: 'Dedicated teacher profiles, class management, and attendance tools.', color: 'bg-secondary/50' },
    { icon: BarChart3, title: 'Analytics Dashboard', description: 'Real-time insights on enrollment, fees, and academic performance.', color: 'bg-primary/50' },
    { icon: Shield, title: 'Secure & Reliable', description: 'Enterprise-grade security with 99.9% uptime and SSL encryption.', color: 'bg-accent/50' },
];

const plans = [
    { name: 'Starter', price: '$29', period: '/month', description: 'Perfect for small schools.', features: ['Up to 200 students', '5 teacher accounts', 'All core features', 'Email support'], popular: false },
    { name: 'Pro', price: '$79', period: '/month', description: 'For growing schools.', features: ['Up to 1,000 students', '25 teacher accounts', 'All features + reports', 'Priority support', 'Custom branding'], popular: true },
    { name: 'School', price: '$199', period: '/month', description: 'For large institutions.', features: ['Unlimited students', 'Unlimited teachers', 'All features + API', 'Dedicated support', 'On-premise option'], popular: false },
];

const testimonials = [
    { name: 'James Robertson', role: 'Principal, Oakridge Academy', text: 'EduAI replaced 4 different tools we were using. The attendance tracking alone saved us 2 hours every day.' },
    { name: 'Sarah Kim', role: 'Admin Director, Sunrise School', text: 'The fee management system is brilliant. Parents can pay online, and reports are automatically generated.' },
    { name: 'Michael Patel', role: 'Director, Global International School', text: 'We manage 1,200 students across 3 campuses from one dashboard. The analytics give us real-time insights.' },
];

export default function Home() {
    return (
        <div className="min-h-screen bg-background">
            <header className="sticky top-0 z-50 border-b border-border bg-card/80 backdrop-blur-sm">
                <div className="max-w-7xl mx-auto flex h-14 items-center justify-between px-4 sm:px-6">
                    <div className="flex items-center gap-2">
                        <div className="h-8 w-8 rounded-lg bg-primary flex items-center justify-center">
                            <span className="text-sm font-bold text-primary-foreground">E</span>
                        </div>
                        <span className="font-semibold text-lg">EduAI</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <Link href="/login">
                            <Button variant="ghost" size="sm">Login</Button>
                        </Link>
                        <Link href="/register">
                            <Button size="sm">Start Free Trial</Button>
                        </Link>
                    </div>
                </div>
            </header>
            
            <section className="py-20 sm:py-32 px-4">
                <div className="max-w-7xl mx-auto text-center">
                    <Badge variant="secondary" className="mb-4">Trusted by 500+ schools worldwide</Badge>
                    <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6">
                        Modern School Management <span className="text-primary">Made Simple</span>
                    </h1>
                    <p className="text-lg text-muted-foreground max-w-2xl mx-auto mb-8">
                        Streamline your school operations with EduAI — the all-in-one platform for student management, attendance, fees, exams, and more.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-3 justify-center">
                        <Link href="/register">
                            <Button size="lg" className="gap-2">
                                Start Free — No Card Needed <ArrowRight className="h-4 w-4" />
                            </Button>
                        </Link>
                        <Link href="/login">
                            <Button variant="outline" size="lg">See Features</Button>
                        </Link>
                    </div>
                </div>
            </section>
            
            <section className="py-12 border-y border-border bg-card/50">
                <div className="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 px-4 text-center">
                    <div><div className="text-3xl font-bold">500+</div><div className="text-sm text-muted-foreground">Schools</div></div>
                    <div><div className="text-3xl font-bold">50K+</div><div className="text-sm text-muted-foreground">Students</div></div>
                    <div><div className="text-3xl font-bold">99.9%</div><div className="text-sm text-muted-foreground">Uptime</div></div>
                    <div><div className="text-3xl font-bold">24/7</div><div className="text-sm text-muted-foreground">Support</div></div>
                </div>
            </section>
            
            <section className="py-20 px-4">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold tracking-tight">Everything Your School Needs</h2>
                        <p className="text-muted-foreground mt-2 max-w-2xl mx-auto">One powerful platform to manage students, teachers, fees, exams, and more.</p>
                    </div>
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {features.map((f, i) => (
                            <Card key={i} className="hover:shadow-md transition-shadow">
                                <CardContent className="p-6">
                                    <div className={`h-10 w-10 rounded-lg ${f.color} flex items-center justify-center mb-4`}>
                                        <f.icon className="h-5 w-5" />
                                    </div>
                                    <h3 className="font-semibold mb-2">{f.title}</h3>
                                    <p className="text-sm text-muted-foreground">{f.description}</p>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                </div>
            </section>
            
            <section className="py-20 px-4 bg-card/30">
                <div className="max-w-5xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold tracking-tight">Simple, Transparent Pricing</h2>
                        <p className="text-muted-foreground mt-2">No hidden fees. Start free, upgrade when ready.</p>
                    </div>
                    <div className="grid md:grid-cols-3 gap-4">
                        {plans.map((plan, i) => (
                            <Card key={i} className={`relative ${plan.popular ? 'border-primary shadow-md' : ''}`}>
                                {plan.popular && <Badge className="absolute -top-3 left-1/2 -translate-x-1/2">Most Popular</Badge>}
                                <CardContent className="p-6">
                                    <h3 className="font-semibold text-lg">{plan.name}</h3>
                                    <div className="mt-2 mb-4">
                                        <span className="text-3xl font-bold">{plan.price}</span>
                                        <span className="text-muted-foreground">{plan.period}</span>
                                    </div>
                                    <p className="text-sm text-muted-foreground mb-4">{plan.description}</p>
                                    <ul className="space-y-2 mb-6">
                                        {plan.features.map((f, j) => (
                                            <li key={j} className="flex items-center gap-2 text-sm">
                                                <Check className="h-4 w-4 text-primary shrink-0" />
                                                {f}
                                            </li>
                                        ))}
                                    </ul>
                                    <Link href="/register">
                                        <Button className="w-full" variant={plan.popular ? 'default' : 'outline'}>
                                            Get Started
                                        </Button>
                                    </Link>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                </div>
            </section>
            
            <section className="py-20 px-4">
                <div className="max-w-7xl mx-auto">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold tracking-tight">Loved by Schools Worldwide</h2>
                    </div>
                    <div className="grid md:grid-cols-3 gap-4">
                        {testimonials.map((t, i) => (
                            <Card key={i}>
                                <CardContent className="p-6">
                                    <div className="flex gap-1 mb-3">
                                        {[...Array(5)].map((_, j) => <Star key={j} className="h-4 w-4 fill-primary text-primary" />)}
                                    </div>
                                    <p className="text-sm text-muted-foreground mb-4">"{t.text}"</p>
                                    <div className="flex items-center gap-3">
                                        <div className="h-10 w-10 rounded-full bg-primary/20 flex items-center justify-center text-sm font-semibold">
                                            {t.name.split(' ').map(n => n[0]).join('')}
                                        </div>
                                        <div>
                                            <div className="text-sm font-medium">{t.name}</div>
                                            <div className="text-xs text-muted-foreground">{t.role}</div>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                </div>
            </section>
            
            <section className="py-20 px-4 bg-gradient-to-r from-secondary via-primary to-accent">
                <div className="max-w-3xl mx-auto text-center">
                    <h2 className="text-3xl font-bold text-white mb-4">Ready to Transform Your School?</h2>
                    <p className="text-white/80 mb-6">Join 500+ schools already using EduAI. Start your free trial today.</p>
                    <Link href="/register">
                        <Button size="lg" className="bg-white text-foreground hover:bg-white/90">
                            Start Free Trial
                        </Button>
                    </Link>
                </div>
            </section>
            
            <footer className="border-t border-border py-8 px-4">
                <div className="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div className="flex items-center gap-2">
                        <div className="h-6 w-6 rounded bg-primary flex items-center justify-center">
                            <span className="text-xs font-bold text-primary-foreground">E</span>
                        </div>
                        <span className="font-semibold">EduAI</span>
                    </div>
                    <p className="text-sm text-muted-foreground">© {new Date().getFullYear()} EduAI. All rights reserved.</p>
                </div>
            </footer>
        </div>
    );
}
