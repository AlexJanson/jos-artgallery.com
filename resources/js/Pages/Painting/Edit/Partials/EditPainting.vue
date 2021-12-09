<template>
    <jet-form-section @submitted="createPainting">
        <template #title> Schilderij aanpassen </template>

        <template #description>
            Vul het formulier in om het aangeklikte schilderij aan te passen.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <input
                    type="file"
                    class="hidden"
                    ref="photoRef"
                    @change="updatePhotoPreview"
                />

                <jet-label for="photo" value="Foto" />

                <div v-show="!photoPreview">
                    <span
                        class="
                            block
                            w-full
                            h-full
                            aspect-w-1 aspect-h-1
                            bg-contain bg-no-repeat bg-center
                            rounded-md
                        "
                        :style="
                            'background-image: url(\'' +
                            '/storage/' +
                            painting.photo +
                            '\');'
                        "
                    >
                    </span>
                </div>

                <div class="mt-2" v-show="photoPreview">
                    <span
                        class="
                            block
                            w-full
                            h-full
                            bg-gray-200
                            aspect-w-1 aspect-h-1
                            bg-cover bg-no-repeat bg-center
                            rounded-md
                        "
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    >
                    </span>
                </div>

                <jet-secondary-button
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Selecteer een foto
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Naam" />
                <jet-input
                    id="name"
                    type="text"
                    v-model="form.name"
                    class="mt-1 block w-full"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="make" value="Soort doek" />
                <jet-input
                    id="make"
                    type="text"
                    v-model="form.make"
                    class="mt-1 block w-full"
                />
                <jet-input-error :message="form.errors.make" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <jet-label for="price" value="Prijs in €" />
                <jet-input
                    id="price"
                    type="number"
                    v-model="form.price"
                    step=".01"
                    class="mt-1 block w-full"
                />
                <jet-input-error :message="form.errors.price" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-1">
                    <jet-label for="width" value="Breedte in cm" />
                    <jet-input
                        id="width"
                        type="number"
                        v-model="form.width"
                        class="mt-1 block w-full"
                    />
                    <jet-input-error
                        :message="form.errors.width"
                        class="mt-2"
                    />
                </div>

                <div class="col-span-6 sm:col-span-1">
                    <jet-label for="height" value="Hoogte in cm" />
                    <jet-input
                        id="height"
                        type="number"
                        v-model="form.height"
                        class="mt-1 block w-full"
                    />
                    <jet-input-error
                        :message="form.errors.height"
                        class="mt-2"
                    />
                </div>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

const { painting } = defineProps({
    painting: {
        type: Object,
    },
});

const form = useForm({
    photo: null,
    name: painting.name,
    price: painting.price,
    make: painting.make,
    width: painting.width,
    height: painting.height,
    id: painting.id,
});

const photoPreview = ref(null);
const photoRef = ref(null);

const createPainting = () => {
    if (photoRef.value) {
        form.photo = photoRef.value.files[0];
    } else {
        form.photo = null;
    }

    form.post(route("painting.update"));
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
</script>
