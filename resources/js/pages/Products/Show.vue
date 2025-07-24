<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Product } from '@/types';

defineProps<{
    product: Product;
}>();
</script>

<template>
    <Head title="商品詳細" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <strong>ID:</strong> {{ product.id }}
                        </div>
                        <div class="mb-4">
                            <strong>商品名:</strong> {{ product.name }}
                        </div>
                        <div class="mb-4">
                            <strong>価格:</strong> {{ product.price }}
                        </div>
                        <div class="flex justify-end">
                            <Link :href="route('products.edit', product.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                編集
                            </Link>
                            <Link :href="route('products.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                一覧に戻る
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
