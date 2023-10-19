<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    songs: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    search_artist: ''
});

const submit = () => {
    form.post(route("dashboard.search"));
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex">
                <div class="flex-1 w-1/6">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
                </div>
                <div class="flex-1 justify-end w-5/6">
                    <div class="flex flex-row items-center justify-end mb-2">
                        
                        <Link :href="route('dashboard')" class="text-slate-50 bg-sky-500 hover:bg-sky-700 rounded-md mx-2 py-1 px-3" >All</Link>

                        <Link :href="route('dashboard.sales')" class="text-slate-50 bg-sky-500 hover:bg-sky-700 rounded-md mx-2 py-1 px-3" >Sales</Link>

                        <Link :href="route('dashboard.top1')" class="text-slate-50 bg-sky-500 hover:bg-sky-700 rounded-md mx-2 py-1 px-3" >Top 1</Link>

                    </div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-row items-center justify-end mb-2">
                            <span class="text-lg font-medium text-slate-50 mr-2">
                                    Search:
                            </span>

                            <form @submit.prevent="submit">
                                <input type="text" v-model="form.search_artist" name="search_artist" class="mt-1 px-3 py-2 border shadow-sm border-slate-300 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 w-52 rounded-md sm:text-sm focus:ring-1" placeholder="Search Here" />
                                <button type="submit" class="bg-sky-500 hover:bg-sky-700 ml-2 py-2 px-3">
                                    Submit
                                </button>
                            </form>

                        </div>
                        <table class="border-collapse border border-slate-500 w-full text-center">
                            <thead>
                                <tr>
                                    <th class="border border-slate-600 bg-slate-700">#</th>
                                    <th class="border border-slate-600 bg-slate-700">Artist Name</th>
                                    <th class="border border-slate-600 bg-slate-700">Album</th>
                                    <th class="border border-slate-600 bg-slate-700">Code</th>
                                    <th class="border border-slate-600 bg-slate-700">Sales</th>
                                    <th class="border border-slate-600 bg-slate-700">Year</th>
                                    <th class="border border-slate-600 bg-slate-700">Album Cover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="song in songs" :key="song.id">
                                    <td class="border border-slate-700">{{ song.id }}</td>
                                    <td class="border border-slate-700">{{ song.artist }}</td>
                                    <td class="border border-slate-700">{{ song.album }}</td>
                                    <td class="border border-slate-700">{{ song.code }}</td>
                                    <td class="border border-slate-700">{{ song.sales }}</td>
                                    <td class="border border-slate-700">{{ song.year }}</td>
                                    <td class="border border-slate-700 flex justify-center">
                                        <img v-if="song.cover" :src="'/images/' + song.cover" :alt="song.artist" width="60">
                                        <img v-else :src="'/images/not-found.jpg'" alt="Not Found" width="60">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
