<template>
    <header class="flex justify-between">
        <div>
            <!-- Company logo -->
        </div>
        <div>
            <!-- Link back to product homepage -->
             <Link href="#">{{productHomeName ?? 'Product homepage'}}</Link>
        </div>
    </header>
    <div class="flex flex-col place-items-center bg-indigo-600 w-full">
        <h1 class="text-white text-2xl m-3 font-bold">Help is only a click away</h1>
        <form class="h-20">
            <!-- Debounced search input -->
            <input type="text" class="rounded-md w-96" placeholder="Type your question..." />
        </form>
    </div>
    <div class="grid grid-cols-3">
        <!-- Pinned Categories -->
    </div>
     <div>
         <!-- Pinned/Frequent Articles -->
     </div>
</template>

<script setup lang="ts">
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
    pinnedCategories: Array<Category>,
    pinnedArticles: Array<Article>,
    productHomeUrl: String,
    productHomeName: String,
})

const searchForm = useForm({
    keywords: ''
})
</script>