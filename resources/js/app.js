import Toasted from 'toastedjs'
import inertiaPages from "./inertiaPages"
import { createInertiaApp, Head, Link } from "@inertiajs/inertia-vue3"
import { setupInertia } from "./utils/inertia"
import { setupAxios } from './utils/axios'
import { isNil } from "lodash"
import { createStore } from "vuex"
import NovaStore from "./stores/nova"
import Localization from "./mixins/Localization"
import { registerComponents, registerNovaComponents, registerJetstreamComponents } from "./components"

window.createNovaApp = config => new Nova(config)

window.Vue = require('vue')
const { createApp, h } = window.Vue

class Nova {
    constructor(config) {
        this.bootingCallbacks = []
        this.bootedCallbacks = []
        this.appConfig = config
        this.pages = inertiaPages

        this.$toasted = new Toasted({
            theme: 'nova',
            position: 'bottom-right',
            duration: 6000,
        })
    }

    /**
     * Register a callback to be called before Nova starts. This is used to bootstrap
     * addons, tools, custom fields, or anything else Nova needs
     */
    booting(callback) {
        this.bootingCallbacks.push(callback)
    }

    boot() {
        this.store = createStore({ ...NovaStore })

        this.bootingCallbacks.forEach(callback => callback(this.app, this.store))
        this.bootingCallbacks = []
    }

    booted(callback) {
        // this.bootedCallbacks.push(callback)
        callback(this.app, this.store)
    }

    async countdown() {
        this.log('Initiating Nova countdown...')

        const appName = this.config('appName')

        await createInertiaApp({
            title: title => (!title ? appName : `${appName} - ${title}`),
            resolve: pageName => {
                return !isNil(this.pages[pageName])
                    ? this.pages[pageName]
                    : this.pages['Web.Error']
            },
            setup: ({el, App, props, plugin}) => {
                this.mountTo = el

                this.app = createApp({ render: () => h(App, props)})

                // TODO: Only needed until Vue 3.3 https://vuejs.org/guide/components/provide-inject.html#working-with-reactivity
                this.app.config.unwrapInjectedRef = true

                this.app.use(plugin)
            }
        })
    }

    async liftOff() {
        this.log('We have lift off!')

        this.boot()

        this.app.use(this.store)

        // register ziggy route
        this.app.mixin({ methods: { route: window.route } })

        this.app.mixin(Localization)

        setupInertia()

        document.addEventListener('inertia:before', () => {
            ;(async () => {
                this.log('Syncing Inertia props to the store...')
                await this.store.dispatch('assignPropsFromInertia')
            })()
        })

        document.addEventListener('inertia:navigate', () => {
            ;(async () => {
                this.log('Syncing Inertia props to the store...')
                await this.store.dispatch('assignPropsFromInertia')
            })()
        })

        // register inertia component to vue
        this.app.component('Link', Link)
        this.app.component('InertiaLink', Link)
        this.app.component('Head', Head)

        registerComponents(this)
        registerNovaComponents(this)
        registerJetstreamComponents(this)

        this.app.mount(this.mountTo)

        this.applyTheme()

        this.log('All systems go...')
    }

    config(key) {
        return this.appConfig[key]
    }

    /**
     * Return an axios instance configured to make requests to Nova's API
     * and handle certain response codes.
     */
    request(options) {
        let axios = setupAxios()

        if (options !== undefined) {
            return axios(options)
        }

        return axios
    }

    /**
     * Register Inertia component.
     */
    inertia(name, component) {
        this.pages[name] = component
    }

    /**
    * Register a custom Vue component.
    */
    component(name, component) {
        if (isNil(this.app._context.components[name])) {
            this.app.component(name, component)
        }
    }

    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    info(message) {
        this.$toasted.show(message, { type: 'info' })
    }

    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    error(message) {
        this.$toasted.show(message, { type: 'error' })
    }

    /**
     * Show a success message to the user.
     *
     * @param {string} message
     */
    success(message) {
        this.$toasted.show(message, { type: 'success' })
    }

    /**
     * Show a warning message to the user.
     *
     * @param {string} message
     */
    warning(message) {
        this.$toasted.show(message, { type: 'warning' })
    }

    /**
     * Log a message to the console with the NOVA prefix
     *
     * @param message
     * @param type
     */
    log(message, type = 'log') {
        console[type](`[Nova]`, message)
    }

    applyTheme() {
        if (Object.keys(this.config('brandColors')).length > 0) {
            const style = document.createElement('style')
            style.innerHTML = this.config('brandColorsCSS')
            document.head.append(style)
        }
    }
}
