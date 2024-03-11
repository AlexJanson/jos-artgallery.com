<template>
    <site-layout>
        <div class="max-w-7xl mx-auto py-8 sm:py-12">

                            <div class="
                    mt-6
                    grid grid-cols-1
                    gap-y-10 gap-x-6
                    sm:grid-cols-2
                    lg:grid-cols-4
                    xl:gap-x-8
                ">
                                        <div v-for="painting in paintings" :key="painting.id" class="group relative">
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

            <Link
                href="/gallery"
                class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    mb-4
                    mt-8
                    bg-blue-800
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-sm text-white
                    uppercase
                    tracking-widest
                    hover:bg-blue-700
                    active:bg-blue-900
                    focus:outline-none
                    focus:border-blue-900
                    focus:ring
                    focus:ring-blue-300
                    disabled:opacity-25
                    transition
                "
            >
                {{ $t("home.cta") }}
            </Link>

            <section>
                <p class="text-lg text-gray-900">
                    Alle schilderijen zijn beschikbaar voor directe aankoop maar
                    zijn ook te huur Het biedt de mogelijkheid om te sparen met
                    als doel eigenaar te worden van het kunstwerk van uw dromen.
                    Ook kunt u het kunstwerk 2x per jaar wisselen voor een ander
                    kunstwerk. Het opgebouwde spaartegoed gaat dan automatisch
                    mee naar het nieuwe kunstwerk!
                </p>
            </section>

            <h2
                class="
                    pt-8
                    text-2xl
                    font-extrabold
                    tracking-tight
                    text-gray-900
                "
            >
                Schilderij huren
            </h2>

            <section class="mt-6 space-y-3">
                <p>
                    Huren of juist kopen? U kunt bij Jos artgallery kunst
                    aankopen maar ook gebruik maken van onze flexibele
                    kunstuitleen of onze renteloze kunstkoopregeling.
                </p>

                <h2
                    class="
                        mt-6
                        text-xl
                        font-extrabold
                        tracking-tight
                        text-gray-900
                    "
                >
                    Kunst voor een maandelijks bedrag
                </h2>

                <p>
                    U  kunt een kunstwerk huren. U betaalt hiervoor een bedrag
                    per maand. Van dit bedrag wordt er maandelijkse een tegoed
                    opgebouwd. Dit tegoed wordt in mindering gebracht wanneer u
                    een kunstwerk wilt aankopen. Bijvoorbeeld: u huurt een
                    kunstwerk met een waarde van €1000,-. Maandelijks betaalt u
                    dan €20,- waarvan u €10,- spaart.
                </p>

                <h2
                    class="
                        mt-6
                        text-xl
                        font-extrabold
                        tracking-tight
                        text-gray-900
                    "
                >
                    U bepaalt wanneer u wilt kopen of ruilen
                </h2>

                <p>
                    Vanaf het moment dat u een kunstwerk heeft, heeft u zelf de
                    touwtjes in handen. Wilt u het kunstwerk ruilen omdat u iets
                    anders heeft gezien, dan blijft het spaartegoed bestaan. Dit
                    tegoed wordt verder opgebouwd met het maandelijks spaardeel
                    van het nieuwe kunstwerk. Huurt u twee kunstwerken waarvan u
                    zeker weet dat u van één nooit meer afstand wilt doen. Dan
                    kan u het opgebouwde spaartegoed gebruiken om dit kunstwerk
                    aan te kopen.
                </p>

                <p>
                    Betaal per maand en spaar om kunst aan te schaffen <br />
                    Te allen tijde wisselen of aankopen <br />
                    Geen inschrijfgeld of maximale huurtermijn.
                </p>
            </section>
        </div>
    </site-layout>
</template>

<script setup>
import SiteLayout from "@/Layouts/SiteLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    paintings: Array
})
</script>
