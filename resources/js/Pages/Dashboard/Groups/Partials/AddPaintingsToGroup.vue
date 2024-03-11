<template>
    <jet-form-section @submitted="">
        <template #title> Schilderijen toevoegen aan groepen </template>

        <template #description>
            Toevoegen van èèn of meerdere schilderijen aan een bestaande groep.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 grid grid-cols-6">
                <p class="block font-medium text-sm text-gray-700 col-span-6">Selecteer een groep</p>

                <!-- Combobox with the existing groups! -->
                <Combobox v-model="selectedGroup" class="col-span-4 sm:col-span-3" v-if="groups.length > 0">
                    <div class="relative mt-1">
                        <div
                            class="relative w-full text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-teal-300 focus-visible:ring-offset-2 sm:text-sm overflow-hidden">
                            <ComboboxInput
                                class="w-full border-none focus:ring-0 py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 capitalize"
                                :displayValue="(group) => group.name" @change="queryGroup = $event.target.value" />
                            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            </ComboboxButton>
                        </div>
                        <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100"
                            leaveTo="opacity-0" @after-leave="queryGroup = ''">
                            <ComboboxOptions
                                class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                <div v-if="filteredGroups.length === 0 && queryGroup !== ''"
                                    class="cursor-default select-none relative py-2 px-4 text-gray-700">
                                    Niets gevonden.
                                </div>

                                <ComboboxOption v-for="(group, index) in filteredGroups" as="template" :key="index"
                                    :value="group" v-slot="{ selected, active }">
                                    <li class="cursor-default select-none relative py-2 pl-10 pr-4" :class="{
                                        'text-white bg-indigo-600': active,
                                        'text-gray-900': !active,
                                    }">
                                        <span class="block truncate capitalize"
                                            :class="{ 'font-medium': selectedGroup, 'font-normal': !selectedGroup }">
                                            {{ group.name }}
                                        </span>
                                        <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3"
                                            :class="{ 'text-white': active, 'text-teal-600': !active }">
                                            <CheckIcon class="w-5 h-5" aria-hidden="true" />
                                        </span>
                                    </li>
                                </ComboboxOption>
                            </ComboboxOptions>
                        </TransitionRoot>
                    </div>
                </Combobox>

                <div v-else class="col-span-6 sm:col-span-6 text-sm">
                    Maak eerst een groep aan om schilderijen aan een groep toe te kunnen voegen.
                </div>
            </div>


            <div class="col-span-6 sm:col-span-6 grid grid-cols-6">
                <p class="block font-medium text-sm text-gray-700 col-span-6">Selecteer een schilderij</p>

                <!-- Combobox with the names of the paintings -->
                <Combobox v-model="selectedPainting" class="col-span-4 sm:col-span-3"
                    v-if="groups.length > 0 && paintings.length > 0">
                    <div class="relative mt-1">
                        <div
                            class="relative w-full text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-teal-300 focus-visible:ring-offset-2 sm:text-sm overflow-hidden">
                            <ComboboxInput
                                class="w-full border-none focus:ring-0 py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 capitalize"
                                :displayValue="(painting) => painting.name"
                                @change="queryPainting = $event.target.value" />
                            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            </ComboboxButton>
                        </div>
                        <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100"
                            leaveTo="opacity-0" @after-leave="queryPainting = ''">
                            <ComboboxOptions
                                class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                <div v-if="filteredPaintings.length === 0 || queryPainting !== ''"
                                    class="cursor-default select-none relative py-2 px-4 text-gray-700">
                                    Niets gevonden.
                                </div>

                                <ComboboxOption v-for="(painting, index) in filteredPaintings" as="template"
                                    :key="index" :value="painting" v-slot="{ selected, active }">
                                    <li class="cursor-default select-none relative py-2 pl-10 pr-4" :class="{
                                        'text-white bg-indigo-600': active,
                                        'text-gray-900': !active,
                                    }">
                                        <span class="block truncate capitalize"
                                            :class="{ 'font-medium': selectedPainting, 'font-normal': !selectedPainting }">
                                            {{ painting.name }}
                                        </span>
                                        <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3"
                                            :class="{ 'text-white': active, 'text-teal-600': !active }">
                                            <CheckIcon class="w-5 h-5" aria-hidden="true" />
                                        </span>
                                    </li>
                                </ComboboxOption>
                            </ComboboxOptions>
                        </TransitionRoot>
                    </div>
                </Combobox>
            </div>

            <!-- List of the added paintings to the selected group -->
            <!-- X icon for deleting it from the current group -->
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Opslaan
            </jet-button>
        </template>

    </jet-form-section>

    {{ paintingsInSelectedGroup }}
</template>

<script setup>
import { ref, computed } from 'vue'
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    paintings: Array,
    groups: Array
});

let selectedGroup = ref()
let queryGroup = ref('')

let filteredGroups = computed(() =>
    queryGroup.value === ''
        ? props.groups
        : props.groups.filter(group =>
            group.name
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(queryGroup.value.toLowerCase().replace(/\s+/g, ''))
        )
)

let selectedPainting = ref()
let queryPainting = ref('')

let filteredPaintings = computed(() => {
    let paintings = queryPainting.value === ''
        ? props.paintings
        : props.paintings.filter(painting =>
            painting.name
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(queryPainting.value.toLowerCase().replace(/\s+/g, ''))
        )

    return paintings.filter(painting => painting.groups.some(group => {
        if (selectedGroup.value)
            return group.name !== selectedGroup.value.name;
        return group;
    }));
})

const paintingsInSelectedGroup = computed(() => {
    if (selectedGroup.value)
        return props.paintings.filter(painting => {
            return painting.groups.some(group => group.name === selectedGroup.value.name)
        })
})

const form = useForm({
    name: null,
});
</script>