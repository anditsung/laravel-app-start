<script setup>
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    responsive: {
        type: Boolean,
        required: true,
    }
})

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <template v-if="! responsive">

        <!-- Account Management -->
        <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-600">
            {{ __('Manage Account') }}
        </div>

        <JetDropdownLink :href="route('profile.show')">
            {{ __('Profile') }}
        </JetDropdownLink>

        <JetDropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
            {{ __('API Tokens') }}
        </JetDropdownLink>

        <div class="border-t border-gray-100 dark:border-gray-700" />

        <!-- Authentication -->
        <form @submit.prevent="logout">
            <JetDropdownLink as="button">
                {{ __('Log Out') }}
            </JetDropdownLink>
        </form>
    </template>
    <template v-else>

        <JetResponsiveNavLink
            :href="route('profile.show')"
            :active="route().current('profile.show')"
        >
            {{ __('Profile') }}
        </JetResponsiveNavLink>

        <JetResponsiveNavLink
            v-if="$page.props.jetstream.hasApiFeatures"
            :href="route('api-tokens.index')"
            :active="route().current('api-tokens.index')"
        >
            {{ __('API Tokens') }}
        </JetResponsiveNavLink>

        <!-- Authentication -->
        <form method="POST" @submit.prevent="logout">
            <JetResponsiveNavLink as="button">
                {{ __('Log Out') }}
            </JetResponsiveNavLink>
        </form>

        <!-- Team Management -->
        <template v-if="$page.props.jetstream.hasTeamFeatures">
            <div class="border-t border-gray-200" />

            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-600">
                {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <JetResponsiveNavLink
                :href="route('teams.show', $page.props.user.current_team)"
                :active="route().current('teams.show')"
            >
                {{ __('Team Settings') }}
            </JetResponsiveNavLink>

            <JetResponsiveNavLink
                v-if="$page.props.jetstream.canCreateTeams"
                :href="route('teams.create')"
                :active="route().current('teams.create')"
            >
                {{ __('Create New Team') }}
            </JetResponsiveNavLink>

            <div class="border-t border-gray-200" />

            <!-- Team Switcher -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Switch Teams') }}
            </div>

            <template v-for="team in $page.props.user.all_teams" :key="team.id">
                <form @submit.prevent="switchToTeam(team)">
                    <JetResponsiveNavLink as="button">
                        <div class="flex items-center">
                            <svg
                                v-if="team.id == $page.props.user.current_team_id"
                                class="mr-2 h-5 w-5 text-green-400"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <div>{{ team.name }}</div>
                        </div>
                    </JetResponsiveNavLink>
                </form>
            </template>
        </template>
    </template>
</template>
