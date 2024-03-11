<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schilderij aanpassen
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <edit-painting :painting="painting" :groups="groups" />
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout";
import EditPainting from "./Partials/EditPainting";

defineProps({
    painting: Object,
    groups: Array
});
</script>
