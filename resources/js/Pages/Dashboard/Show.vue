<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <create-painting />

                <jet-section-border />

                <list-paintings :paintings="props.paintings" />

                <jet-section-border />
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout";
import ListPaintings from "@/Pages/Dashboard/Partials/ListPaintings";
import CreatePainting from "@/Pages/Dashboard/Partials/CreatePainting";
import JetSectionBorder from "@/Jetstream/SectionBorder";

const props = defineProps({
    paintings: Array,
});
</script>
