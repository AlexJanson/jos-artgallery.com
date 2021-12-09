<template>
    <site-layout :title="'About'">
        <div class="max-w-7xl mx-auto py-8 sm:py-12">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
                {{ $t("about.heading") }}
            </h2>

            <section class="mt-6 whitespace-pre-wrap">
                {{ $t("about.body") }}
            </section>

            <footer class="mt-6 whitespace-pre-wrap font-bold">
                {{ $t("about.footer") }}
            </footer>
        </div>
    </site-layout>
</template>

<script setup>
import SiteLayout from "@/Layouts/SiteLayout.vue";
</script>
