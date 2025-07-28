<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    people: Array,
});

const form = useForm({});

const deletePerson = (id) => {
    if (confirm('本当に削除しますか？')) {
        form.delete(route('people.destroy', id));
    }
};
</script>

<template>
    <Head title="担当者一覧" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">担当者一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <Link :href="route('people.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                新規登録
                            </Link>
                            <a :href="route('people.export.excel')" class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Export
                            </a>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">氏名</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">メールアドレス</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">所属</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="person in people" :key="person.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ person.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ person.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ person.email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ person.affiliation ? person.affiliation.name : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('people.show', person.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">詳細</Link>
                                        <Link :href="route('people.edit', person.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">編集</Link>
                                        <button @click="deletePerson(person.id)" class="text-red-600 hover:text-red-900">削除</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
