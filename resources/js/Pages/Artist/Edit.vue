<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    artist: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.artist[0].id,
    name: props.artist[0].name,
    code: props.artist[0].code
});

const update = () => {
    form.patch(route('artists.update', props.artist[0].id));
};

</script>

<template>
    <Head title="Edit Artist" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex">
                <div class="flex-1 w-1/6">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Artist</h2>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl w-2/4 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="update">
                            <div class="flex flex-col justify-center w-full">
                            
                                <div class="mb-3">
                                    <label class="block">
                                        <span class="block text-sm text-slate-50 font-medium">Name:</span>
                                        <input type="text" v-model="form.name" name="name" class="text-slate-700 mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500" required />
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="block">
                                        <span class="block text-sm text-slate-50 font-medium">Code:</span>
                                        <input type="text" v-model="form.code" name="code" class="text-slate-700 mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500" required />
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="bg-sky-500 hover:bg-sky-700 py-2 px-3 border border-sky-500 rounded-md">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>             
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
