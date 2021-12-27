require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

import * as VueI18n from "vue-i18n";
import { en, nl } from "./languages";

const i18n = VueI18n.createI18n({
    locale: "nl",
    fallbackLocale: "en",
    messages: {
        en,
        nl,
    },
});

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        createApp({
            render: () => h(app, props),
        })
            .use(plugin)
            .use(i18n)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4f46e5", showSpinner: true });
