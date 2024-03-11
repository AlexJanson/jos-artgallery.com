<template>
    <jet-form-section>
        <template #title> Groep verwijderen </template>

        <template #description>
            Vul het formulier in om een bestaande groep te verwijderen.
        </template>

        <template #form>
            <Listbox v-model="selected" class="col-span-6 sm:col-span-2" v-if="props.groups.length > 0">
                <div class="relative mt-1">
                    <ListboxButton
                        class="relative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm">
                        <span class="block truncate">{{ selected.name }}</span>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                        </span>
                    </ListboxButton>

                    <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                        <ListboxOptions
                            class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption v-slot="{ active, selected }" v-for="group in props.groups" :key="group.name"
                                :value="group" as="template">
                                <li :class="[
                                    active ? 'text-indigo-900 bg-indigo-100' : 'text-gray-900',
                                    'cursor-default select-none relative py-2 pl-10 pr-4',
                                ]">
                                    <span :class="[
                                        selected ? 'font-medium' : 'font-normal',
                                        'block truncate',
                                    ]">{{ group.name }}</span>
                                    <span v-if="selected"
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600">
                                        <CheckIcon class="w-5 h-5" aria-hidden="true" />
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>

            <div v-else class="col-span-6 sm:col-span-6 text-sm text-gray-700 block font-medium">
                Nog geen groepen aangemaakt. Maak eerst een groep aan.
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-danger-button @click="deleteGroup" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing || !selected || props.groups.length === 0">
                Delete
            </jet-danger-button>
        </template>

    </jet-form-section>
</template>

<script setup>
import { ref, watch } from 'vue';
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue';
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid';
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    groups: Array,
});

watch(() => props.groups, (first, second) => {
    selected.value = props.groups[0]
});

const selected = ref(props.groups[0]);

const form = useForm({
    id: null,
});

const deleteGroup = () => {
    form.id = selected.value.id

    form.delete(route("dashboard.groups.delete"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>