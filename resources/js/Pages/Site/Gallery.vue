<template>
    <site-layout :title="'Gallery'">
        <div class="max-w-2xl mx-auto py-8 sm:py-12 lg:max-w-7xl">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">
                                    {{ $t("gallery.heading") }}
                                </h2>

                                <div class="flex items-center">
                                    <span class="mr-6">Filter:</span>
                                    <div class="w-44">
                                        <Listbox v-model="selectedGroup">
                                            <div class="relative mt-1">
                                                <ListboxButton
                                                    class="focus:outline-none relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-300 sm:text-sm">
                                                    <span class="block truncate capitalize">{{ selectedGroup.name
                                                    }}</span>
                                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                                        <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                                    </span>
                                                </ListboxButton>
                                                <transition leave-active-class="transition duration-100 ease-in"
                                                    leave-from-class="opacity-100" leave-to-class="opacity-0">
                                                    <ListboxOptions
                                                        class="focus:outline-none z-50 absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 sm:text-sm">
                                                        <ListboxOption v-slot="{ active, selected }" v-for="group in props.groups"
                                                            :key="group.name" :value="group" as="template">
                                                            <li :class="[
                                                                active ? 'bg-indigo-100 text-indigo-900' : 'text-gray-900',
                                                                'relative cursor-default select-none py-2 pl-10 pr-4',
                                                            ]">
                                                                <span :class="[
                                                                    selected ? 'font-medium' : 'font-normal',
                                                                    'block truncate capitalize',
                                                                ]">{{ group.name }}</span>
                                                                <span v-if="selected"
                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-indigo-600">
                                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                                </span>
                                                            </li>
                                                        </ListboxOption>
                                                    </ListboxOptions>
                                                </transition>
                                            </div>
                                        </Listbox>
                                    </div>
                                </div>
                            </div>

                            <div class="
                    mt-6
                    grid grid-cols-1
                    gap-y-10 gap-x-6
                    sm:grid-cols-2
                    lg:grid-cols-4
                    xl:gap-x-8
                ">
                                <div v-for="painting in filteredPaintings" :key="painting.id" class="group relative">
                                    <div v-show="painting.sold != 0" class="
                            absolute
                            text-right
                            right-10
                            lg:right-3
                            text-xl
                            bg-yellow-300 bg-opacity-80
                            z-40
                            pointer-events-none
                        ">
                                        Verkocht
                                    </div>
                                    <div class="
                            w-full
                            min-h-80
                            aspect-w-1 aspect-h-1
                            rounded-md
                            overflow-hidden
                            group-hover:opacity-75
                            lg:h-80 lg:aspect-none
                        ">
                                        <img :src="'/storage/' + painting.photo" :alt="painting.name" loading="lazy" class="
                                w-full
                                h-full
                                object-center object-contain
                                lg:w-full lg:h-full
                            " />
                                    </div>
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <h3 class="text-sm text-gray-700">
                                                <Link :href="'/gallery/' + painting.slug">
                                                <span aria-hidden="true" class="absolute inset-0" />
                                                {{ painting.name }}
                                                </Link>
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ painting.make }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 text-right">
                                                € {{ painting.price }}
                                            </p>
                                            <p class="text-sm font-medium text-gray-900 text-right">
                                                {{ painting.width }} x {{ painting.height }} (in cm)
                                            </p>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </site-layout>
</template>

<script setup>
import { computed, ref } from "vue";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

const props = defineProps({
    paintings: Array,
    groups: Array
});

props.groups.unshift({ id: -1, group_id: -1, name: 'Geen' });
const selectedGroup = ref(props.groups[0]);

const filteredPaintings = computed(() =>
    selectedGroup.value.id == -1
        ? props.paintings
        : props.paintings.filter((painting =>
            painting.group_id == selectedGroup.value.id
        ))
)
</script>
