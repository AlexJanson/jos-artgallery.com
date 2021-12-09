<template>
    <site-layout :title="'Gallery'">
        <div class="max-w-2xl mx-auto py-8 sm:py-12 lg:max-w-7xl">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
                {{ $t("gallery.heading") }}
            </h2>

            <div
                class="
                    mt-6
                    grid grid-cols-1
                    gap-y-10 gap-x-6
                    sm:grid-cols-2
                    lg:grid-cols-4
                    xl:gap-x-8
                "
            >
                <div
                    v-for="painting in paintings"
                    :key="painting.id"
                    class="group relative"
                >
                    <div
                        v-show="painting.sold != 0"
                        class="
                            absolute
                            text-right
                            right-10
                            lg:right-3
                            text-xl
                            bg-yellow-300 bg-opacity-80
                            z-50
                            pointer-events-none
                        "
                    >
                        Verkocht
                    </div>
                    <div
                        class="
                            w-full
                            min-h-80
                            aspect-w-1 aspect-h-1
                            rounded-md
                            overflow-hidden
                            group-hover:opacity-75
                            lg:h-80 lg:aspect-none
                        "
                    >
                        <img
                            :src="'/storage/' + painting.photo"
                            :alt="painting.name"
                            class="
                                w-full
                                h-full
                                object-center object-contain
                                lg:w-full lg:h-full
                            "
                        />
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <Link :href="'/gallery/' + painting.slug">
                                    <span
                                        aria-hidden="true"
                                        class="absolute inset-0"
                                    />
                                    {{ painting.name }}
                                </Link>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ painting.make }}
                            </p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">
                            € {{ painting.price }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </site-layout>
</template>

<script setup>
import SiteLayout from "@/Layouts/SiteLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    paintings: Array,
});
</script>
