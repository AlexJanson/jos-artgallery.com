<template>
    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schilderijen
            </h2>

            <div class="flex flex-col mt-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="
                            py-2
                            align-middle
                            inline-block
                            min-w-full
                            sm:px-6
                            lg:px-8
                        "
                    >
                        <div
                            class="
                                shadow
                                overflow-hidden
                                border-b border-gray-200
                                sm:rounded-lg
                            "
                        >
                            <table class="min-w-full">
                                <thead
                                    class="bg-gray-50 border-b border-gray-200"
                                >
                                    <tr>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Naam
                                        </th>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Soort doek
                                        </th>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Prijs in €
                                        </th>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Dimensies
                                        </th>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Bekeken
                                        </th>
                                        <th
                                            scope="col"
                                            class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            "
                                        >
                                            Verkocht
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative px-6 py-3"
                                        >
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                    v-if="paintings.length !== 0"
                                >
                                    <draggable
                                        v-model="props.paintings"
                                        tag="transition-group"
                                        item-key="name"
                                        v-bind="dragOptions"
                                        :component-data="{
                                            type: 'transition-group',
                                            name: !dragging
                                                ? 'flip-list'
                                                : null,
                                        }"
                                        @start="dragging = true"
                                        @end="dragging = false"
                                    >
                                        <template #item="{ element }">
                                            <tr>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-900
                                                        "
                                                    >
                                                        {{ element.name }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-900
                                                        "
                                                    >
                                                        {{ element.make }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-900
                                                        "
                                                    >
                                                        {{ element.price }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-900
                                                        "
                                                    >
                                                        {{ element.width }} x
                                                        {{ element.height }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-900
                                                        "
                                                    >
                                                        {{ element.views }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    <jet-checkbox
                                                        :checked="
                                                            element.sold != 0
                                                        "
                                                        @change="
                                                            updateSold(
                                                                $event,
                                                                element.id
                                                            )
                                                        "
                                                    />
                                                </td>
                                                <td
                                                    class="
                                                        px-6
                                                        py-4
                                                        whitespace-nowrap
                                                        text-right text-sm
                                                        font-medium
                                                    "
                                                >
                                                    <jet-button class="mr-2">
                                                        <a
                                                            :href="
                                                                '/storage/' +
                                                                element.photo
                                                            "
                                                            target="_blank"
                                                        >
                                                            Bekijk foto
                                                        </a>
                                                    </jet-button>

                                                    <jet-danger-button
                                                        @click="
                                                            deletePainting(
                                                                element.id
                                                            )
                                                        "
                                                        class="mr-2"
                                                    >
                                                        Delete
                                                    </jet-danger-button>

                                                    <Link
                                                        :href="
                                                            route(
                                                                'painting.edit',
                                                                element.slug
                                                            )
                                                        "
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            px-4
                                                            py-2
                                                            bg-white
                                                            border
                                                            border-gray-300
                                                            rounded-md
                                                            font-semibold
                                                            text-xs
                                                            text-gray-700
                                                            uppercase
                                                            tracking-widest
                                                            shadow-sm
                                                            hover:text-gray-500
                                                            focus:outline-none
                                                            focus:border-blue-300
                                                            focus:ring
                                                            focus:ring-blue-200
                                                            active:text-gray-800
                                                            active:bg-gray-50
                                                            disabled:opacity-25
                                                            transition
                                                        "
                                                    >
                                                        Edit
                                                    </Link>
                                                </td>
                                            </tr>
                                        </template>
                                    </draggable>
                                </tbody>
                                <div v-else class="px-6 py-4">
                                    <span
                                        class="
                                            text-xs text-gray-500
                                            italic
                                            sm:text-sm
                                        "
                                    >
                                        Nog geen schilderijen.
                                    </span>
                                </div>
                            </table>
                            <div
                                class="
                                    border-t border-gray-200
                                    px-6
                                    py-3
                                    whitespace-nowrap
                                    bg-gray-100
                                    flex
                                    items-center
                                    bg-gray-50
                                    shadow
                                    sm:rounded-bl-md sm:rounded-br-md
                                "
                            >
                                <jet-button @click="reorder">
                                    Opslaan
                                </jet-button>

                                <jet-action-message
                                    :on="reorderForm.recentlySuccessful"
                                    class="ml-3"
                                >
                                    Opgeslagen.
                                </jet-action-message>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetButton from "@/Jetstream/Button";
import JetCheckbox from "@/Jetstream/Checkbox";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import draggable from "vuedraggable";
import { computed } from "vue";

const props = defineProps({
    paintings: Array,
});

const deletePainting = (id) => {
    const form = useForm({
        id,
    });

    form.delete(route("painting.delete"));
};

const updateSold = (evt, id) => {
    let sold = evt.target.checked;

    const form = useForm({
        id,
        sold,
    });

    form.put(route("painting.sold"), { preserveScroll: true });
};

let dragging = false;
let dragOptions = computed(() => {
    return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
    };
});

const reorderForm = useForm({
    ids: null,
    orders: null,
});

const reorder = () => {
    let ids = [];
    let orders = [];
    props.paintings.map((painting, index) => {
        ids.push(painting.id);
        orders.push(index);
    });

    reorderForm.ids = ids;
    reorderForm.orders = orders;
    // const form = useForm({
    //     ids,
    //     orders,
    // });

    reorderForm.put(route("paintings.order"), { preserveScroll: true });
};
</script>

<style>
.flip-list-move {
    transition: transform 500ms;
}

.no-move {
    transition: transform 0ms;
}

.ghost {
    opacity: 0;
}
</style>
