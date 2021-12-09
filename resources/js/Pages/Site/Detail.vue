<template>
    <site-layout :title="painting.name">
        <div class="mx-auto py-8 sm:py-12 md:max-w-7xl">
            <div class="lg:grid lg:grid-cols-7">
                <div
                    class="
                        block
                        aspect-w-3 aspect-h-4
                        rounded-lg
                        overflow-hidden
                        lg:col-span-4
                    "
                >
                    <img
                        :src="'/storage/' + painting.photo"
                        class="w-full h-full object-center object-contain"
                        ref="photo"
                    />
                </div>

                <div class="mt-6 px-6 lg:px-8 lg:mt-0 lg:col-span-3">
                    <h2
                        class="
                            flex
                            justify-between
                            text-2xl
                            font-extrabold
                            tracking-tight
                            text-gray-900
                        "
                    >
                        <span>{{ painting.name }}</span
                        ><span>€ {{ painting.price }}</span>
                    </h2>

                    <p class="mt-6">{{ painting.make }}</p>
                    <p>
                        Dimensies in cm (B x H): {{ painting.width }} x
                        {{ painting.height }}
                    </p>

                    <h2
                        class="
                            text-2xl
                            font-extrabold
                            tracking-tight
                            text-gray-900
                            mt-10
                            px-4
                            bg-yellow-300 bg-opacity-80
                            w-min
                        "
                        v-show="painting.sold != 0"
                    >
                        Verkocht
                    </h2>
                </div>
            </div>
        </div>
    </site-layout>
</template>

<script setup>
import { onMounted, nextTick, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

import SiteLayout from "@/Layouts/SiteLayout";

const props = defineProps({
    painting: Object,
});

const photo = ref();

onMounted(() => {
    const form = useForm({
        id: props.painting.id,
    });

    form.post(route("painting.view"), { preserveScroll: true });

    nextTick(() => {
        photo.value.scrollIntoView({ behavior: "smooth" });
    });
});
</script>
