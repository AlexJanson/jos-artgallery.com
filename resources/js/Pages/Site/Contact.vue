<template>
    <site-layout :title="'Contact'">
        <div class="max-w-7xl mx-auto py-8 sm:py-12">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
                {{ $t("contact.heading") }}
            </h2>

            <p class="mt-4 text-gray-500 w-2/3">
                {{ $t("contact.lead") }}
            </p>

            <section class="mt-6">
                <h2 class="text-lg font-extrabold tracking-tight text-gray-900">
                    {{ $t("contact.formHeading") }}
                </h2>

                <form @submit.prevent="submit">
                    <div class="sm:rounded-md">
                        <div class="py-5 bg-white">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-2">
                                    <label
                                        for="first-name"
                                        class="
                                            block
                                            text-sm
                                            font-medium
                                            text-gray-700
                                        "
                                        >{{ $t("contact.formName") }}</label
                                    >
                                    <input
                                        type="text"
                                        name="first-name"
                                        id="first-name"
                                        v-model="form.name"
                                        autocomplete="given-name"
                                        class="
                                            mt-1
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            shadow-sm
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                    />

                                    <jet-input-error
                                        :message="form.errors.name"
                                        class="mt-2"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label
                                        for="last-name"
                                        class="
                                            block
                                            text-sm
                                            font-medium
                                            text-gray-700
                                        "
                                        >{{ $t("contact.formLastName") }}</label
                                    >
                                    <input
                                        type="text"
                                        name="last-name"
                                        id="last-name"
                                        v-model="form.lastname"
                                        autocomplete="family-name"
                                        class="
                                            mt-1
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            shadow-sm
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                    />

                                    <jet-input-error
                                        :message="form.errors.lastname"
                                        class="mt-2"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="email-address"
                                        class="
                                            block
                                            text-sm
                                            font-medium
                                            text-gray-700
                                        "
                                        >{{ $t("contact.formEmail") }}</label
                                    >
                                    <input
                                        type="text"
                                        name="email-address"
                                        id="email-address"
                                        v-model="form.email"
                                        autocomplete="email"
                                        class="
                                            mt-1
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            shadow-sm
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                    />

                                    <jet-input-error
                                        :message="form.errors.email"
                                        class="mt-2"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label
                                        for="subject"
                                        class="
                                            block
                                            text-sm
                                            font-medium
                                            text-gray-700
                                        "
                                        >{{ $t("contact.formSubject") }}</label
                                    >
                                    <input
                                        type="text"
                                        name="subject"
                                        id="subject"
                                        v-model="form.subject"
                                        class="
                                            mt-1
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            shadow-sm
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                    />

                                    <jet-input-error
                                        :message="form.errors.subject"
                                        class="mt-2"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <div class="flex flex-row justify-between">
                                        <label
                                            for="message"
                                            class="
                                                block
                                                text-sm
                                                font-medium
                                                text-gray-700
                                            "
                                        >
                                            {{ $t("contact.formMessage") }}
                                        </label>
                                        <p class="mt-2 text-sm text-gray-500">
                                            {{ $t("contact.formMessageMax") }}
                                        </p>
                                    </div>
                                    <div class="mt-1">
                                        <textarea
                                            id="message"
                                            name="message"
                                            v-model="form.message"
                                            rows="5"
                                            class="
                                                shadow-sm
                                                focus:ring-indigo-500
                                                focus:border-indigo-500
                                                mt-1
                                                block
                                                w-full
                                                sm:text-sm
                                                border border-gray-300
                                                rounded-md
                                            "
                                        />

                                        <jet-input-error
                                            :message="form.errors.message"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <button
                                type="submit"
                                class="
                                    inline-flex
                                    justify-center
                                    py-2
                                    px-4
                                    border border-transparent
                                    shadow-sm
                                    text-sm
                                    font-medium
                                    rounded-md
                                    text-white
                                    bg-indigo-600
                                    hover:bg-indigo-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-offset-2
                                    focus:ring-indigo-500
                                "
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                {{ $t("contact.formSend") }}
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </site-layout>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import SiteLayout from "@/Layouts/SiteLayout";
import JetInputError from "@/Jetstream/InputError";

const form = useForm({
    name: null,
    lastname: null,
    email: null,
    subject: null,
    message: null,
});

const submit = () => {
    form.post(route("contact.send"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
