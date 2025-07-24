<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Customer } from '@/types';

defineProps<{
    customers: Customer[];
}>();
</script>

<template>
    <Head title="Customers" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-end mb-4">
                            <Link :href="route('customers.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                新規登録
                            </Link>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        顧客名
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        メールアドレス
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        担当者
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">アクション</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="customer in customers" :key="customer.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ customer.id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ customer.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ customer.email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ customer.person ? customer.person.name : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('customers.show', customer.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">詳細</Link>
                                        <Link :href="route('customers.edit', customer.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">編集</Link>
                                        <Link :href="route('customers.destroy', customer.id)" method="delete" as="button" class="text-red-600 hover:text-red-900">削除</Link>
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
