import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    return (
        <div className="bg-gradient-to-r from-blue-400 to-indigo-600 min-h-screen flex flex-col justify-center items-center">

            <div className="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800">

                <div className="flex justify-center mb-4">
                    <Link href="/">
                        <ApplicationLogo className="h-40 w-40 fill-current text-gray-500" />
                    </Link>
                </div>

                {children}
            </div>
        </div>
    );
}
