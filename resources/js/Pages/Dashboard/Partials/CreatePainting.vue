<template>
    <jet-form-section @submitted="createPainting">
        <template #title> Schilderij toevoegen </template>

        <template #description>
            Vul het formulier in om een nieuw schilderij toe te voegen aan de
            galerij.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden" ref="photoRef" @change="updatePhotoPreview" />

                <jet-label for="photo" value="Foto" />

                <div class="mt-2" v-show="photoPreview">
                    <span class="
                            block
                            w-full
                            h-full
                            aspect-w-1 aspect-h-1
                            bg-contain bg-no-repeat bg-center
                            rounded-md
                        " :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        ">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Selecteer een foto
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Naam" />
                <jet-input id="name" type="text" v-model="form.name" class="mt-1 block w-full" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="make" value="Soort doek" />
                <jet-input id="make" type="text" v-model="form.make" class="mt-1 block w-full" />
                <jet-input-error :message="form.errors.make" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <jet-label for="price" value="Prijs in €" />
                <jet-input id="price" type="number" v-model="form.price" step=".01" class="mt-1 block w-full" />
                <jet-input-error :message="form.errors.price" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 grid grid-cols-6 gap-6">
                <p class="block font-medium text-sm text-gray-700 col-span-6 sm:col-span-6">Selecteer een groep</p>

                <!-- Dropdown with the existing groups! -->
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
                                <ListboxOption v-slot="{ active, selected }" v-for="group in props.groups"
                                    :key="group.name" :value="group" as="template">
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
            </div>

            <div class="col-span-6 sm:col-span-6 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-1">
                    <jet-label for="width" value="Breedte in cm" />
                    <jet-input id="width" type="number" v-model="form.width" class="mt-1 block w-full" />
                    <jet-input-error :message="form.errors.width" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-1">
                    <jet-label for="height" value="Hoogte in cm" />
                    <jet-input id="height" type="number" v-model="form.height" class="mt-1 block w-full" />
                    <jet-input-error :message="form.errors.height" class="mt-2" />
                </div>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
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
import { useForm } from "@inertiajs/inertia-vue3";

import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

const props = defineProps({
    groups: Array
})

watch(() => props.groups, (first, second) => {
    selected.value = props.groups[0]
});

const selected = ref(props.groups[0]);

const form = useForm({
    photo: null,
    name: null,
    price: null,
    make: null,
    width: null,
    height: null,
    group_id: null
});

const photoPreview = ref(null);
const photoRef = ref(null);

const createPainting = () => {
    if (photoRef.value) {
        form.photo = photoRef.value.files[0];
    }

    form.group_id = selected.value.id;

    form.post(route("painting.create"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
            form.reset();
            window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
        },
    });
};

const selectNewPhoto = () => {
    photoRef.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoRef.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
    if (photoRef?.value.value) {
        photoRef.value.value = null;
    }
};
</script>
