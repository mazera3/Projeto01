import Navbar from '@/Components/AuthenticatedLayout/Navbar';
import Sidebar from '@/Components/AuthenticatedLayout/Sidebar';
import { usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthenticatedLayout({ children }) {
    const user = usePage().props.auth.user;

    const [sidebarOpen, setSidebarOpen] = useState(false);

    return (
        <div className="relative flex h-screen bg-gray-100 dark:bg-gray-900">

            {sidebarOpen && (
                <div
                    className="fixed inset-0 z-30 bg-black opacity-50 sm:hidden"
                    onClick={() => setSidebarOpen(false)}
                ></div>
            )}

            {/* Sidebar */}
            <Sidebar sidebarOpen={sidebarOpen} setSidebarOpen={setSidebarOpen} />

            <div className="flex-1 flex flex-col overflow-hidden">

                {/* Navbar */}
                <Navbar user={user} sidebarOpen={sidebarOpen} setSidebarOpen={setSidebarOpen} />

                {/* Conteúdo da página */}
                <div className="flex-1 flex flex-col overflow-hidden">
                    <main className="flex-1 overflow-y-auto p-3 bg-gray-100 dark:bg-gray-900">
                        {children}
                    </main>
                </div>
            </div>

        </div>
    );
}