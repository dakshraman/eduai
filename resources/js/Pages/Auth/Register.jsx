import GuestLayout from '@/layouts/GuestLayout';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator';
import { Alert, AlertDescription } from '@/components/ui/alert';

export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        school_name: '',
        school_code: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });
    
    const submit = (e) => {
        e.preventDefault();
        post('/register');
    };
    
    return (
        <GuestLayout title="Register">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Create your school</h1>
                    <p className="text-muted-foreground mt-1">Start your 14-day free trial</p>
                </div>
                
                <form onSubmit={submit} className="space-y-4">
                    <div className="space-y-3">
                        <h3 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">School</h3>
                        <div className="space-y-2">
                            <Label>School Name</Label>
                            <Input value={data.school_name} onChange={(e) => setData('school_name', e.target.value)} placeholder="Oakridge Academy" required />
                            {errors.school_name && <p className="text-sm text-destructive">{errors.school_name}</p>}
                        </div>
                        <div className="space-y-2">
                            <Label>School Code</Label>
                            <Input value={data.school_code} onChange={(e) => setData('school_code', e.target.value)} placeholder="OAK" required />
                            {errors.school_code && <p className="text-sm text-destructive">{errors.school_code}</p>}
                        </div>
                    </div>
                    
                    <Separator />
                    
                    <div className="space-y-3">
                        <h3 className="text-sm font-medium text-muted-foreground uppercase tracking-wider">Admin Account</h3>
                        <div className="space-y-2">
                            <Label>Full Name</Label>
                            <Input value={data.name} onChange={(e) => setData('name', e.target.value)} placeholder="John Doe" required />
                            {errors.name && <p className="text-sm text-destructive">{errors.name}</p>}
                        </div>
                        <div className="space-y-2">
                            <Label>Email</Label>
                            <Input type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} placeholder="admin@school.com" required />
                            {errors.email && <p className="text-sm text-destructive">{errors.email}</p>}
                        </div>
                        <div className="space-y-2">
                            <Label>Password</Label>
                            <Input type="password" value={data.password} onChange={(e) => setData('password', e.target.value)} placeholder="Min 8 characters" required />
                            {errors.password && <p className="text-sm text-destructive">{errors.password}</p>}
                        </div>
                        <div className="space-y-2">
                            <Label>Confirm Password</Label>
                            <Input type="password" value={data.password_confirmation} onChange={(e) => setData('password_confirmation', e.target.value)} placeholder="Repeat password" required />
                        </div>
                    </div>
                    
                    {Object.keys(errors).length > 0 && (
                        <Alert variant="destructive">
                            <AlertDescription>Please fix the errors above.</AlertDescription>
                        </Alert>
                    )}
                    
                    <Button type="submit" className="w-full" disabled={processing}>
                        {processing ? 'Creating...' : 'Create account'}
                    </Button>
                </form>
                
                <p className="text-center text-sm text-muted-foreground">
                    Already have an account?{' '}
                    <Link href="/login" className="font-medium text-primary hover:underline">Sign in</Link>
                </p>
            </div>
        </GuestLayout>
    );
}
