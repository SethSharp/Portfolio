import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

export default function Index({auth}) {
    return (
        <AuthenticatedLayout
            user={auth.user}
        >
            Blogs page
        </AuthenticatedLayout>
    );
}
