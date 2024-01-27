import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.jsx';
import {Head, useForm} from "@inertiajs/react";

export default function Index({ auth }) {

    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

      return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Blog" />

         Creating blog
        </AuthenticatedLayout>
      );
}
