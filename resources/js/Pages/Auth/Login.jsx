import GuestLayout from '@/layouts/GuestLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent } from '@/components/ui/card';
import { Alert, AlertDescription } from '@/components/ui/alert';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });
    
    const submit = (e) => {
        e.preventDefault();
        post('/login');
    };
    
    return (
        <GuestLayout title="Login">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Welcome back</h1>
                    <p className="text-muted-foreground mt-1">Sign in to your account to continue</p>
                </div>
                
                <form onSubmit={submit} className="space-y-4">
                    <div className="space-y-2">
                        <Label htmlFor="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            placeholder="admin@eduai.com"
                            required
                        />
                        {errors.email && <p className="text-sm text-destructive">{errors.email}</p>}
                    </div>
                    
                    <div className="space-y-2">
                        <Label htmlFor="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder="Enter your password"
                            required
                        />
                        {errors.password && <p className="text-sm text-destructive">{errors.password}</p>}
                    </div>
                    
                    <div className="flex items-center gap-2">
                        <input
                            type="checkbox"
                            id="remember"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                            className="rounded border-input"
                        />
                        <Label htmlFor="remember" className="text-sm text-muted-foreground">Remember me</Label>
                    </div>
                    
                    {errors.message && (
                        <Alert variant="destructive">
                            <AlertDescription>{errors.message}</AlertDescription>
                        </Alert>
                    )}
                    
                    <Button type="submit" className="w-full" disabled={processing}>
                        {processing ? 'Signing in...' : 'Sign in'}
                    </Button>
                </form>
                
                <p className="text-center text-sm text-muted-foreground">
                    Don't have an account?{' '}
                    <Link href="/register" className="font-medium text-primary hover:underline">Sign up</Link>
                </p>
            </div>
        </GuestLayout>
    );
}
