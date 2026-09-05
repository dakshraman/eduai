import { Link } from '@inertiajs/react';

export default function GuestLayout({ children, title }) {
    return (
        <div className="flex min-h-screen">
            <div className="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-secondary via-primary to-accent">
                <div className="relative z-10 flex flex-col items-center justify-center w-full p-12">
                    <Link href="/" className="mb-8">
                        <div className="h-16 w-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <span className="text-3xl font-bold text-white">E</span>
                        </div>
                    </Link>
                    <h1 className="text-4xl font-bold text-white text-center mb-4">EduAI</h1>
                    <p className="text-white/80 text-center text-lg max-w-sm">
                        Modern school management platform for the digital age.
                    </p>
                    <div className="mt-12 grid grid-cols-2 gap-4 w-full max-w-sm">
                        <div className="rounded-xl bg-white/10 backdrop-blur-sm p-4 text-center">
                            <div className="text-2xl font-bold text-white">500+</div>
                            <div className="text-sm text-white/70">Schools</div>
                        </div>
                        <div className="rounded-xl bg-white/10 backdrop-blur-sm p-4 text-center">
                            <div className="text-2xl font-bold text-white">50K+</div>
                            <div className="text-sm text-white/70">Students</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div className="flex-1 flex items-center justify-center p-6 sm:p-12 bg-background">
                <div className="w-full max-w-md">
                    <div className="lg:hidden flex items-center gap-2 mb-8 justify-center">
                        <div className="h-10 w-10 rounded-xl bg-primary flex items-center justify-center">
                            <span className="text-xl font-bold text-primary-foreground">E</span>
                        </div>
                        <span className="text-2xl font-bold">EduAI</span>
                    </div>
                    {children}
                </div>
            </div>
        </div>
    );
}
