import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, useForm } from "@inertiajs/react";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Transition } from "@headlessui/react";
import Form from "@/Components/Form/Form.jsx";

export default function Index({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        title: "",
        slug: "",
        content: "",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("dashboard.blogs.store"), {
            preserveScroll: true,
            onSuccess: () => {},
        });
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Blog" />

            <Form>
                <form onSubmit={submit}>
                    <TextInput
                        id="title"
                        type="title"
                        name="title"
                        value={data.title}
                        className="mt-1 block w-full"
                        isFocused={true}
                        label="Title"
                        onChange={(e) => setData("title", e.target.value)}
                    />

                    <TextInput
                        id="slug"
                        type="slug"
                        name="slug"
                        value={data.slug}
                        className="mt-1 block w-full"
                        label="Slug"
                        onChange={(e) => setData("slug", e.target.value)}
                    />

                    <TextInput
                        id="content"
                        type="content"
                        name="content"
                        value={data.content}
                        className="mt-1 block w-full"
                        label="Content"
                        onChange={(e) => setData("content", e.target.value)}
                    />

                    <div className="mt-6 justify-end">
                        <PrimaryButton disabled={processing}>
                            Save
                        </PrimaryButton>
                    </div>
                </form>
            </Form>
        </AuthenticatedLayout>
    );
}
