import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import {Head, useForm} from "@inertiajs/react";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import SelectBox from '@/Components/Form/SelectBox.jsx'
import Form from "@/Components/Form/Form.jsx";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import ComponentWrapper from "@/Components/Form/ComponentWrapper.jsx";

export default function Index({auth}) {
    const {data, setData, post, processing, errors, reset} = useForm({
        title: "",
        slug: "",
        meta_title: "",
        meta_description: "",
        meta_tags: "",
        content: "",
    });

    const publish = (e) => {
        e.preventDefault();

        post(route("dashboard.blogs.store"), {
            preserveScroll: true,
            onSuccess: () => {
            },
        });
    };

    const draft = (e) => {
        e.preventDefault();

        post(route("dashboard.blogs.store"), {
            preserveScroll: true,
            onSuccess: () => {
            },
        });
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Blog"/>
            <div>
                <form className="w-3/4">
                    <Form>
                        <div slot="content">
                            <ComponentWrapper>
                                <TextInput
                                    id="title"
                                    type="title"
                                    name="title"
                                    value={data.title}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    label="Title"
                                    onChange={(e) =>
                                        setData("title", e.target.value)
                                    }
                                />
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <TextInput
                                    id="slug"
                                    type="slug"
                                    name="slug"
                                    value={data.slug}
                                    className="mt-1 block w-full"
                                    label="Slug"
                                    onChange={(e) =>
                                        setData("slug", e.target.value)
                                    }
                                />
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <SelectBox label="Select a tag"/>
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <TextInput
                                    id="meta_title"
                                    type="meta_title"
                                    name="meta_title"
                                    value={data.meta_title}
                                    className="mt-1 block w-full"
                                    label="Meta Title"
                                    onChange={(e) =>
                                        setData("meta_title", e.target.value)
                                    }
                                />
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <TextInput
                                    id="meta_description"
                                    type="meta_description"
                                    name="meta_description"
                                    value={data.meta_description}
                                    className="mt-1 block w-full"
                                    label="Meta Description"
                                    onChange={(e) =>
                                        setData(
                                            "meta_description",
                                            e.target.value,
                                        )
                                    }
                                />
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <TextInput
                                    id="meta_tags"
                                    type="meta_tags"
                                    name="meta_tags"
                                    value={data.meta_tags}
                                    className="mt-1 block w-full"
                                    label="Meta Tags"
                                    onChange={(e) =>
                                        setData("meta_tags", e.target.value)
                                    }
                                />
                            </ComponentWrapper>

                            <ComponentWrapper>
                                <TextInput
                                    id="content"
                                    type="content"
                                    name="content"
                                    value={data.content}
                                    className="mt-1 block w-full"
                                    label="Content"
                                    onChange={(e) =>
                                        setData("content", e.target.value)
                                    }
                                />
                            </ComponentWrapper>
                        </div>

                        <div slot="actions">
                            <div className="flex gap-x-2 flex-row-reverse">
                                <PrimaryButton
                                    onClick={publish}
                                    disabled={processing}
                                >
                                    Publish
                                </PrimaryButton>

                                <SecondaryButton
                                    onClick={draft}
                                    disabled={processing}
                                >
                                    Save as Draft
                                </SecondaryButton>
                            </div>
                        </div>
                    </Form>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
