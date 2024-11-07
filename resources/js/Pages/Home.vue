<template>
    <Head title="Home"></Head>
    <MainLayout>
        <PageHeader />
        <div class="flex flex-col sm:flex-row place-items-center justify-center bg-primary-600 w-full h-48">
            <h1 class="text-white text-2xl m-3 font-bold">Find answers to your questions</h1>
            <button 
                type="button" 
                class="group flex h-12 w-72 rounded-md items-center justify-center sm:justify-start md:h-auto md:w-80 md:flex-none md:rounded-lg md:py-2.5 md:pl-4 md:pr-3.5 md:text-sm md:ring-1 md:ring-gray-200 md:hover:ring-gray-300 lg:w-96 bg-white"
                @click="searchModalVisible = !searchModalVisible"
            >
                <MagnifyingGlass />
                <span class="text-lg sm:ml-2 text-gray-500">Search support library...</span>
            </button>
            <Teleport to="body">
                <SearchModal 
                    v-if="searchModalVisible" 
                    @close-modal="searchModalVisible = false"
                />
            </Teleport>
        </div>
        <div 
            v-if="featuredCategories.length > 0"
            class="grid px-4 sm:px-0 gap-4 my-6"
            :class="{'sm:grid-cols-3': featuredCategories.length >= 3, 'sm:grid-cols-2': featuredCategories.length == 2, 'sm:grid-cols-1': featuredCategories.length == 1,}"
        >
            <!-- Featured Categories -->
            <Link v-for="category in featuredCategories"  :href="route('category.view',category.slug)" class="hover:cursor-pointer" :key="category.slug">
                <p class="border-primary-400 border-2 rounded-md text-center text-primary-500 text-xl p-4 hover:text-primary-700 hover:border-primary-700">
                    {{ category.name }}
                </p>
            </Link>
        </div>
         <div class="px-4 sm:px-0" v-if="featuredArticles.length > 0">
             <!-- Featured Articles -->
            <h2 class="text-xl">Promoted articles</h2>
            <ul class="text-lg columns-2 sm:columns-3 gap-8 my-4">
                <li v-for="article in featuredArticles" class="py-4 first:pt-0 border-b-[1px] break-inside-avoid" :key="article.slug">
                    <Link :href="route('article.view',article.slug)" class="text-primary-500 hover:text-primary-700">{{ article.name }}</Link>
                </li>
            </ul>
         </div>
    </MainLayout>
</template>

<script setup lang="ts">
import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import PageHeader from '@/Components/PageHeader.vue';
import SearchModal from '@/Components/SearchModal.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Article, Category } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    featuredCategories: Array<Category>;
    featuredArticles: Array<Article>;
}

defineProps<Props>()

const searchModalVisible = ref(false)
</script>
