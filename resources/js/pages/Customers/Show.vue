<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Customer } from '@/types';

defineProps<{
    customer: Customer;
}>();
</script>

<template>
    <Head title="View Customer" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Customer</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <strong>ID:</strong> {{ customer.id }}
                        </div>
                        <div class="mb-4">
                            <strong>Name:</strong> {{ customer.name }}
                        </div>
                        <div class="mb-4">
                            <strong>Email:</strong> {{ customer.email }}
                        </div>
                        <div class="mb-4">
                            <strong>Person:</strong> {{ customer.person ? customer.person.name : 'N/A' }}
                        </div>
                        <div class="flex justify-end">
                            <Link :href="route('customers.edit', customer.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                編集
                            </Link>
                            <Link :href="route('customers.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                一覧に戻る
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
