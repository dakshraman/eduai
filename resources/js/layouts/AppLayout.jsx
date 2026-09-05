import { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';
import { 
    LayoutDashboard, Users, GraduationCap, UserCheck, BookOpen, 
    Calendar, ClipboardCheck, DollarSign, FileText, Bell, CalendarDays,
    Truck, Library, Clock, CreditCard, Settings, LogOut, Menu,
    ChevronLeft, ChevronRight, User
} from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { 
    DropdownMenu, DropdownMenuContent, DropdownMenuItem, 
    DropdownMenuSeparator, DropdownMenuTrigger 
} from '@/components/ui/dropdown-menu';
import { 
    Sheet, SheetContent, SheetTrigger 
} from '@/components/ui/sheet';
import { Separator } from '@/components/ui/separator';
import { Alert, AlertDescription } from '@/components/ui/alert';

const navigation = [
    { name: 'Dashboard', href: '/dashboard', icon: LayoutDashboard },
    { name: 'Students', href: '/students', icon: Users },
    { name: 'Teachers', href: '/teachers', icon: GraduationCap },
    { name: 'Parents', href: '/parents', icon: UserCheck },
    { name: 'Classes', href: '/classes', icon: BookOpen },
    { name: 'Attendance', href: '/attendance', icon: ClipboardCheck },
    { name: 'Fees', href: '/fees/categories', icon: DollarSign },
    { name: 'Exams', href: '/exams', icon: FileText },
    { name: 'Notices', href: '/notices', icon: Bell },
    { name: 'Events', href: '/events', icon: CalendarDays },
    { name: 'Transport', href: '/transport', icon: Truck },
    { name: 'Library', href: '/library', icon: Library },
    { name: 'Academic Years', href: '/academic-years', icon: Clock },
    { name: 'Billing', href: '/billing', icon: CreditCard },
    { name: 'Settings', href: '/settings', icon: Settings },
];

function SidebarContent({ collapsed, setCollapsed }) {
    const { url } = usePage();
    
    return (
        <div className="flex h-full flex-col bg-card border-r border-border">
            <div className="flex h-14 items-center border-b border-border px-4">
                <Link href="/dashboard" className="flex items-center gap-2">
                    <div className="h-8 w-8 rounded-lg bg-primary flex items-center justify-center">
                        <span className="text-sm font-bold text-primary-foreground">E</span>
                    </div>
                    {!collapsed && <span className="font-semibold text-lg">EduAI</span>}
                </Link>
            </div>
            
            <nav className="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                {navigation.map((item) => {
                    const isActive = url.startsWith(item.href);
                    return (
                        <Link
                            key={item.name}
                            href={item.href}
                            className={`flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors ${
                                isActive 
                                    ? 'bg-accent text-accent-foreground' 
                                    : 'text-muted-foreground hover:bg-accent/50 hover:text-accent-foreground'
                            }`}
                        >
                            <item.icon className="h-5 w-5 shrink-0" />
                            {!collapsed && <span>{item.name}</span>}
                        </Link>
                    );
                })}
            </nav>
            
            <div className="hidden lg:flex border-t border-border p-2">
                <Button variant="ghost" size="sm" className="w-full" onClick={() => setCollapsed(!collapsed)}>
                    {collapsed ? <ChevronRight className="h-4 w-4" /> : <ChevronLeft className="h-4 w-4" />}
                </Button>
            </div>
        </div>
    );
}

export default function AppLayout({ children, title }) {
    const [collapsed, setCollapsed] = useState(false);
    const [mobileOpen, setMobileOpen] = useState(false);
    const { auth, flash } = usePage().props;
    const user = auth?.user;
    
    const initials = user?.name?.split(' ').map(n => n[0]).join('').toUpperCase() || 'U';
    
    return (
        <div className="flex min-h-screen bg-background">
            <aside className={`hidden lg:flex lg:flex-col fixed inset-y-0 left-0 z-40 transition-all duration-200 ${collapsed ? 'w-16' : 'w-64'}`}>
                <SidebarContent collapsed={collapsed} setCollapsed={setCollapsed} />
            </aside>
            
            <Sheet open={mobileOpen} onOpenChange={setMobileOpen}>
                <SheetContent side="left" className="w-64 p-0">
                    <SidebarContent collapsed={false} setCollapsed={() => setMobileOpen(false)} />
                </SheetContent>
            </Sheet>
            
            <div className={`flex-1 flex flex-col transition-all duration-200 ${collapsed ? 'lg:ml-16' : 'lg:ml-64'}`}>
                <header className="sticky top-0 z-30 flex h-14 items-center gap-4 border-b border-border bg-card/80 backdrop-blur-sm px-4 sm:px-6">
                    <Button variant="ghost" size="icon" className="lg:hidden" onClick={() => setMobileOpen(true)}>
                        <Menu className="h-5 w-5" />
                    </Button>
                    
                    <div className="flex-1" />
                    
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" className="relative h-9 w-9 rounded-full">
                                <Avatar className="h-9 w-9">
                                    <AvatarFallback className="bg-primary/20 text-primary-foreground text-sm">{initials}</AvatarFallback>
                                </Avatar>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end" className="w-48">
                            <div className="flex items-center gap-2 p-2">
                                <Avatar className="h-8 w-8">
                                    <AvatarFallback className="bg-primary/20 text-xs">{initials}</AvatarFallback>
                                </Avatar>
                                <div className="flex flex-col">
                                    <span className="text-sm font-medium">{user?.name}</span>
                                    <span className="text-xs text-muted-foreground">{user?.email}</span>
                                </div>
                            </div>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem asChild>
                                <Link href="/profile">Profile</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="/settings">Settings</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="/billing">Billing</Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem 
                                className="text-destructive cursor-pointer"
                                onClick={() => router.post('/logout')}
                            >
                                <LogOut className="mr-2 h-4 w-4" />
                                Log out
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </header>
                
                <main className="flex-1 p-4 sm:p-6">
                    {flash?.success && (
                        <div className="mb-4">
                            <Alert>
                                <AlertDescription className="text-emerald-700">{flash.success}</AlertDescription>
                            </Alert>
                        </div>
                    )}
                    {flash?.error && (
                        <div className="mb-4">
                            <Alert variant="destructive">
                                <AlertDescription>{flash.error}</AlertDescription>
                            </Alert>
                        </div>
                    )}
                    {children}
                </main>
            </div>
        </div>
    );
}
