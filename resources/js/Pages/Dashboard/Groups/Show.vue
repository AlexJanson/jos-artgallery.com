<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Groups
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <create-group :paintings="props.paintings" />

                <jet-section-border />

                <delete-group :groups="props.groups" />

                <jet-section-border />
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import CreateGroup from "./Partials/CreateGroup.vue";
import DeleteGroup from "./Partials/DeleteGroup.vue";
import AddPaintingsToGroup from "./Partials/AddPaintingsToGroup.vue";

const props = defineProps({
    paintings: Array,
    groups: Array
});
</script>
