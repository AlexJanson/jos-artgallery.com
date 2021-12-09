<template>
    <Head :title="title" />

    <jet-banner class="sticky w-full left-0 top-0" />

    <div class="max-w-6xl mx-auto px-6 xl:px-0">
        <navigation />
        <img
            class="object-cover w-full rounded"
            src="../../assets/banner_home.png"
            alt="Home banner"
        />
        <slot />
    </div>
</template>

<script setup>
import Navigation from "@/Components/Navigation";
import JetBanner from "@/Jetstream/Banner";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    title: {
        required: false,
        type: String,
        default: "Home",
    },
});
</script>
