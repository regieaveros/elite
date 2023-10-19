<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    albums: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

const destroy = (id) => {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('albums.delete', id));
    }
};

</script>

<template>
    <Head title="Albums" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex">
                <div class="flex-1 w-1/6">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Albums</h2>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div
                            v-if="$page.props.flash.success"
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert"
                        >
                            <span class="font-medium">
                                {{ $page.props.flash.success }}
                            </span>
                        </div>
                        <table class="border-collapse border border-slate-500 w-full text-center">
                            <thead>
                                <tr>
                                    <th class="border border-slate-600 bg-slate-700">#</th>
                                    <th class="border border-slate-600 bg-slate-700">Year</th>
                                    <th class="border border-slate-600 bg-slate-700">Name</th>
                                    <th class="border border-slate-600 bg-slate-700">Sales</th>
                                    <th class="border border-slate-600 bg-slate-700">Cover</th>
                                    <th class="border border-slate-600 bg-slate-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="album in albums" :key="album.id">
                                    <td class="border border-slate-700">{{ album.id }}</td>
                                    <td class="border border-slate-700">{{ album.year }}</td>
                                    <td class="border border-slate-700">{{ album.name }}</td>
                                    <td class="border border-slate-700">{{ album.sales }}</td>
                                    <td class="border border-slate-700">
                                        <div class="flex justify-center">
                                            <img v-if="album.cover" :src="'/images/' + album.cover" :alt="album.name" width="60">
                                            <img v-else :src="'/images/not-found.jpg'" alt="Not Found" width="60">
                                        </div>
                                    </td>
                                    <td class="border border-slate-700">
                                        <Link :href="route('albums.edit', album.id)" class="bg-sky-500 hover:bg-sky-700 ml-2 py-2 px-3">Update</Link>
                                        <button @click="destroy(album.id)" class="bg-red-500 hover:bg-red-600 ml-2 py-2 px-3">
                                            Delete
                                        </button>
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
