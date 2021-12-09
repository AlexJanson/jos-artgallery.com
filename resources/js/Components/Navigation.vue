<template>
    <nav class="flex items-center justify-between h-28">
        <Link
            href="/"
            class="
                text-gray-500
                font-bold
                uppercase
                text-2xl
                lg:text-3xl
                tracking-tighter
                inline
            "
        >
            <span class="text-blue-400">J</span>os art gallery
        </Link>

        <div class="hidden md:flex uppercase font-bold text-sm space-x-5">
            <img
                class="object-contain cursor-pointer"
                src="../../assets/nl.png"
                alt="NL flag"
                @click="switchLocale('nl')"
            />
            <img
                class="object-contain cursor-pointer"
                src="../../assets/en.png"
                alt="UK flag"
                @click="switchLocale('en')"
            />
            <Link
                href="/"
                :class="[route().current('home') ? 'text-blue-400' : '']"
                >{{ $t("navigation.home") }}</Link
            >
            <Link
                :href="route('gallery')"
                :class="[route().current('gallery') ? 'text-blue-400' : '']"
                >{{ $t("navigation.gallery") }}</Link
            >
            <Link
                :href="route('about')"
                :class="[route().current('about') ? 'text-blue-400' : '']"
                >{{ $t("navigation.about") }}</Link
            >
            <Link
                :href="route('leasing')"
                :class="[route().current('leasing') ? 'text-blue-400' : '']"
                >{{ $t("navigation.leasing") }}</Link
            >
            <Link
                :href="route('contact')"
                :class="[route().current('contact') ? 'text-blue-400' : '']"
                >{{ $t("navigation.contact") }}</Link
            >
        </div>

        <div class="flex md:hidden">
            <Popover v-slot="{ open }" class="relative">
                <PopoverButton
                    class="
                        bg-white
                        rounded-md
                        p-2
                        inline-flex
                        items-center
                        justify-center
                        text-gray-400
                        cursor-pointer
                        hover:text-gray-500 hover:bg-gray-100
                        focus:outline-none
                        focus:ring-2
                        focus:ring-inset
                        focus:ring-indigo-500
                    "
                >
                    <span class="sr-only">Open menu</span>
                    <MenuIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>

                <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="translate-y-1 opacity-0"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-to-class="translate-y-1 opacity-0"
                >
                    <PopoverPanel
                        class="
                            absolute
                            z-10
                            w-screen
                            max-w-xs
                            px-4
                            mt-3
                            transform
                            -right-10
                            sm:px-0
                            lg:max-w-3xl
                        "
                    >
                        <div
                            class="
                                overflow-hidden
                                rounded-lg
                                shadow-lg
                                ring-1 ring-black ring-opacity-5
                            "
                        >
                            <div
                                class="
                                    flex flex-col
                                    relative
                                    bg-white
                                    py-4
                                    px-7
                                    space-y-2
                                "
                            >
                                <Link
                                    href="/"
                                    :class="[
                                        route().current('home')
                                            ? 'text-blue-400'
                                            : '',
                                    ]"
                                    >{{ $t("navigation.home") }}</Link
                                >
                                <Link
                                    :href="route('gallery')"
                                    :class="[
                                        route().current('gallery')
                                            ? 'text-blue-400'
                                            : '',
                                    ]"
                                    >{{ $t("navigation.gallery") }}</Link
                                >
                                <Link
                                    :href="route('about')"
                                    :class="[
                                        route().current('about')
                                            ? 'text-blue-400'
                                            : '',
                                    ]"
                                    >{{ $t("navigation.about") }}</Link
                                >
                                <Link
                                    :href="route('leasing')"
                                    :class="[
                                        route().current('leasing')
                                            ? 'text-blue-400'
                                            : '',
                                    ]"
                                    >{{ $t("navigation.leasing") }}</Link
                                >
                                <Link
                                    :href="route('contact')"
                                    :class="[
                                        route().current('contact')
                                            ? 'text-blue-400'
                                            : '',
                                    ]"
                                    >{{ $t("navigation.contact") }}</Link
                                >
                            </div>
                            <div class="py-4 px-12 bg-gray-50 flex space-x-5">
                                <img
                                    class="object-contain cursor-pointer"
                                    src="../../assets/nl.png"
                                    alt="NL flag"
                                    @click="switchLocale('nl')"
                                />
                                <img
                                    class="object-contain cursor-pointer"
                                    src="../../assets/en.png"
                                    alt="UK flag"
                                    @click="switchLocale('en')"
                                />
                            </div>
                        </div>
                    </PopoverPanel>
                </transition>
            </Popover>
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import {
    BookmarkAltIcon,
    CalendarIcon,
    ChartBarIcon,
    CursorClickIcon,
    MenuIcon,
    PhoneIcon,
    PlayIcon,
    RefreshIcon,
    ShieldCheckIcon,
    SupportIcon,
    ViewGridIcon,
    XIcon,
    ChevronDownIcon,
} from "@heroicons/vue/outline";
import {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from "@headlessui/vue";
import { useI18n } from "vue-i18n";

const i18n = useI18n();
const switchLocale = (locale) => (i18n.locale.value = locale);
</script>
