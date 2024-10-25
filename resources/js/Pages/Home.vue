<template>
    <MainLayout>
        <PageHeader />
        <div class="flex flex-col place-items-center bg-indigo-600 w-full py-6">
            <h1 class="text-white text-2xl m-3 font-bold">Help is only a click away</h1>
            <button 
                type="button" 
                class="group flex h-12 w-6 items-center justify-center sm:justify-start md:h-auto md:w-80 md:flex-none md:rounded-lg md:py-2.5 md:pl-4 md:pr-3.5 md:text-sm md:ring-1 md:ring-slate-200 md:hover:ring-slate-300 lg:w-96 bg-white"
                @click="searchModalVisible = !searchModalVisible"
            >
                <svg aria-hidden="true" viewBox="0 0 20 20" class="h-5 w-5 flex-none fill-slate-400 group-hover:fill-slate-500 md:group-hover:fill-slate-400">
                    <path d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"></path>
                </svg>
                <span class="sr-only md:not-sr-only md:ml-2 md:text-slate-500">Search support docs</span>
            </button>
            <Teleport to="body">
                <SearchModal 
                    v-if="searchModalVisible" 
                    @close-modal="searchModalVisible = false"
                />
            </Teleport>
        </div>
        <div class="grid grid-cols-3 gap-2 m-2 ">
            <!-- Featured Categories -->
            <Link v-for="category in featuredCategories"  :href="route('category.view',category.slug)" class="hover:cursor-pointer">
                <p class="border-indigo-400 border-2 rounded-md text-center text-indigo-500 text-xl p-4 hover:text-indigo-700 hover:border-indigo-700">
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
import SearchModal from '@/Components/SearchModal.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Article, Category } from '@/types';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    featuredCategories: Array<Category>;
    featuredArticles: Array<Article>;
}

defineProps<Props>()

const searchModalVisible = ref(false)
</script>