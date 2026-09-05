import AppLayout from '@/layouts/AppLayout';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';

export default function Index({ user }) {
    const profileForm = useForm({
        name: user?.name || '',
        email: user?.email || '',
        phone: user?.phone || '',
    });

    const passwordForm = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const handleProfile = (e) => {
        e.preventDefault();
        profileForm.put(route('admin.profile.update'));
    };

    const handlePassword = (e) => {
        e.preventDefault();
        passwordForm.put(route('admin.profile.password'), {
            onSuccess: () => passwordForm.reset(),
        });
    };

    const initials = user?.name?.split(' ').map((n) => n[0]).join('').toUpperCase().slice(0, 2) || 'U';

    return (
        <AppLayout title="Profile">
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">My Profile</h1>
                    <p className="text-muted-foreground">Manage your account settings.</p>
                </div>

                <Card>
                    <CardContent className="p-6">
                        <div className="flex items-center gap-4">
                            <div className="h-16 w-16 rounded-full bg-primary flex items-center justify-center text-primary-foreground text-xl font-bold">
                                {initials}
                            </div>
                            <div>
                                <p className="text-lg font-semibold">{user?.name}</p>
                                <p className="text-sm text-muted-foreground">{user?.email}</p>
                                <Badge variant="secondary" className="mt-1">{user?.role || 'Admin'}</Badge>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <div className="grid gap-6 lg:grid-cols-2">
                    <Card>
                        <CardHeader><CardTitle className="text-base">Edit Profile</CardTitle></CardHeader>
                        <CardContent>
                            <form onSubmit={handleProfile} className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="name">Full Name</Label>
                                    <Input id="name" value={profileForm.data.name} onChange={(e) => profileForm.setData('name', e.target.value)} />
                                    {profileForm.errors.name && <p className="text-sm text-destructive">{profileForm.errors.name}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="email">Email</Label>
                                    <Input id="email" type="email" value={profileForm.data.email} onChange={(e) => profileForm.setData('email', e.target.value)} />
                                    {profileForm.errors.email && <p className="text-sm text-destructive">{profileForm.errors.email}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input id="phone" value={profileForm.data.phone} onChange={(e) => profileForm.setData('phone', e.target.value)} />
                                </div>
                                <Button type="submit" disabled={profileForm.processing}>Save Changes</Button>
                            </form>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader><CardTitle className="text-base">Change Password</CardTitle></CardHeader>
                        <CardContent>
                            <form onSubmit={handlePassword} className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="current_password">Current Password</Label>
                                    <Input id="current_password" type="password" value={passwordForm.data.current_password} onChange={(e) => passwordForm.setData('current_password', e.target.value)} />
                                    {passwordForm.errors.current_password && <p className="text-sm text-destructive">{passwordForm.errors.current_password}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="password">New Password</Label>
                                    <Input id="password" type="password" value={passwordForm.data.password} onChange={(e) => passwordForm.setData('password', e.target.value)} />
                                    {passwordForm.errors.password && <p className="text-sm text-destructive">{passwordForm.errors.password}</p>}
                                </div>
                                <div className="space-y-2">
                                    <Label htmlFor="password_confirmation">Confirm Password</Label>
                                    <Input id="password_confirmation" type="password" value={passwordForm.data.password_confirmation} onChange={(e) => passwordForm.setData('password_confirmation', e.target.value)} />
                                </div>
                                <Button type="submit" disabled={passwordForm.processing}>Update Password</Button>
                            </form>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
