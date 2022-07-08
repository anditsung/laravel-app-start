<template>
    <Link :href="href" class="text-sm text-primary-500 rounded hover:text-primary-400 focus:outline-none focus:ring focus:ring-primary-300 dark:focus:ring-primary-700">
        <slot />
    </Link>
</template>

<script>
export default {
    props: {
        href: String
    }
}
</script>
