import { usePage } from "@inertiajs/inertia-vue3"

export default {
    state: () => ({
        menus: [],
        pages: [],
    }),

    getters: {
        menus: s => s.menus,
        pages: s => s.pages,
    },

    mutations: {

    },

    actions: {
        async assignPropsFromInertia({ state }) {
            Nova.appConfig = usePage().props.value.novaConfig || Nova.appConfig

            // let { menus, pages } = config
            // state.menus = menus
            // state.pages = pages
        }
    }
}
