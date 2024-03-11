<template>
    <jet-form-section @submitted="createGroup">
        <template #title> Groep toevoegen </template>

        <template #description>
            Vul het formulier in om een nieuwe groep toe te voegen.
        </template>

        <template #form>
            <div class="col-span-4 sm:col-span-2">
                <jet-label for="name" value="Groep naam" />
                <jet-input id="name" type="text" v-model="form.name" class="mt-1 block w-full" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
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
</template>

<script setup>
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    paintings: Array
});

const form = useForm({
    name: null,
});

const createGroup = () => {
    form.post(route('dashboard.groups.create'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    });
}
</script>