import {camelCase, upperFirst} from "lodash";

export function registerComponents(app) {
    const requireComponent = require.context(
        './components',
        true,
        /[A-Z]\w+\.(vue)$/
    )

    requireComponent.keys().forEach(fileName => {
        const componentConfig = requireComponent(fileName)

        const componentName = upperFirst(
            camelCase(
                fileName
                    .split('/')
                    .pop()
                    .replace(/\.\w+$/, '')
            )
        )

        app.component(componentName, componentConfig.default || componentConfig)
    })
}

export function registerNovaComponents(app) {
    const requireComponent = require.context(
        './Nova',
        true,
        /[A-Z]\w+\.(vue)$/
    )

    requireComponent.keys().forEach(fileName => {
        const componentConfig = requireComponent(fileName)

        const componentName = upperFirst(
            camelCase(
                fileName
                    .split('/')
                    .pop()
                    .replace(/\.\w+$/, '')
            )
        )

        app.component(componentName, componentConfig.default || componentConfig)
    })
}

export function registerJetstreamComponents(app) {
    const requireComponent = require.context(
        './Jetstream',
        true,
        /[A-Z]\w+\.(vue)$/
    )

    requireComponent.keys().forEach(fileName => {
        const componentConfig = requireComponent(fileName)

        const componentName = upperFirst(
            camelCase(
                fileName
                    .split('/')
                    .pop()
                    .replace(/\.\w+$/, '')
            )
        )

        app.component(`Jet${componentName}`, componentConfig.default || componentConfig)
    })
}
