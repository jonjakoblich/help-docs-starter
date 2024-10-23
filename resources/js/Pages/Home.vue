<template>
    <MainLayout>
        <PageHeader />
        <div class="flex flex-col place-items-center bg-indigo-600 w-full py-6">
            <h1 class="text-white text-2xl m-3 font-bold">Help is only a click away</h1>
            <form class="h-20">
                <!-- Debounced search input -->
                <input type="text" class="rounded-md w-96" placeholder="Type your question..." />
            </form>
        </div>
        <div class="grid grid-cols-3 gap-2 m-2 ">
            <!-- Featured Categories -->
            <Link v-for="category in featuredCategories"  :href="route('category.view',category.slug)">
                <p class="border-indigo-500 border-2 rounded-md text-center text-indigo-500 text-xl p-4 hover:text-indigo-700 hover:border-indigo-700">
                    {{ category.name }}
                </p>
            </Link>
        </div>
         <div class="">
             <!-- Featured Articles -->
            <ul>
                <li v-for="article in featuredArticles">
                    <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                </li>
            </ul>
         </div>
    </MainLayout>
</template>

<script setup lang="ts">
import PageHeader from '@/Components/PageHeader.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

interface Category {
    name: String;
    slug: String;
}

interface Article {
    name: String;
    slug: String;
}

defineProps({
    featuredCategories: Array<Category>,
    featuredArticles: Array<Article>,
})

const searchForm = useForm({
    keywords: ''
})
</script>