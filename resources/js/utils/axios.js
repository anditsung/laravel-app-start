import axios from "axios";
import isNil from "lodash/isNil";
import { Inertia } from "@inertiajs/inertia";

export function setupAxios() {
    const instance = axios.create()

    instance.interceptors.response.use(
        response => response,
        error => {
            if (error instanceof axios.Cancel) {
                return Promise.reject(error)
            }

            const response = error.response

            const {
                status,
                data: { redirect }
            } = response

            if (status >= 500) {
                Nova.error(error.response.data.message)
            }

            if (status === 401) {
                if (!isNil(redirect)) {
                    location.href = redirect
                    return
                }

                Inertia.get(route('login'))
            }

            if (status === 403) {
                Inertia.get(route('Error'), {
                    status: 403
                })
            }

            if (status === 419) {
                Nova.error("Token expired. please refresh browser before continue")
            }

            return Promise.reject(error)
        }
    )

    return instance
}
