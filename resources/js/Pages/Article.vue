<template>
    <InnerPageLayout>
        <template #navigation>
            <SidebarNavigation :navigation="navigation" />
        </template>
        <template #content>
            <article class="prose max-w-full">
                <h1>{{ article.name }}</h1>
                <div v-html="article.content"></div>
            </article>
            <footer class="flex justify-between mt-8 border-t-gray-100 border-t-2 divide-x-2 divide-x-gray-100 py-4">
                <div v-if="previous != null" class="w-1/2 pr-4">
                    <p class="font-bold text-gray-500">Previous article</p>
                    <p class="text-xl text-gray-400 hover:text-indigo-500 hover:cursor-pointer"><Link :href="route('article.view',previous.slug)">{{previous.name}}</Link></p>
                </div>
                <div v-if="next != null" class="w-1/2 text-right pl-4">
                    <p class="font-bold text-gray-500 text-right">Next article</p>
                    <p class="text-xl text-gray-400 hover:text-indigo-500 hover:cursor-pointer"><Link :href="route('article.view',next.slug)">{{next.name}}</Link></p>
                </div>
            </footer>
        </template>
    </InnerPageLayout>
</template>


<script setup lang="ts">
import InnerPageLayout from '@/Layouts/InnerPageLayout.vue';
import SidebarNavigation from '@/Components/SidebarNavigation.vue';
import { Article } from '@/types';
import { Link } from '@inertiajs/vue3';

interface Props {
    article: Article;
    navigation: Array<Article>;
    previous: Article;
    next: Article;
}

defineProps<Props>()

</script>