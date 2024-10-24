<template>
    <InnerPageLayout>
        <template #navigation>
            <SidebarNavigation :navigation="navigation" />
        </template>
        <template #content>
            <article class="prose max-w-full">
                <p>Updated: {{ new Date(article.updated_at).toLocaleDateString('en-US',{
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                }) }}</p>
                <h1>{{ article.name }}</h1>
                <div v-html="article.content"></div>
                <div class="flex gap-1 mt-8">
                    Categories: <Link v-for="(category, index) in article.categories" :href="route('category.view',category.slug)" class="text-indigo-500 hover:text-indigo-700">{{ category.name }}</Link>
                </div>
            </article>
            <ArticleHelpfulVote :metrics="helpfulMetrics" />
            <footer
                class="flex divide-x-2 divide-x-gray-100"
                :class="{'justify-end': previous == null, 'justify-between': previous != null && next != null}"
            >
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
import { Article, HelpfulMetrics } from '@/types';
import { Link } from '@inertiajs/vue3';
import ArticleHelpfulVote from '@/Components/ArticleHelpfulVote.vue';

interface Props {
    article: Article;
    navigation: Array<Article>;
    previous: Article;
    next: Article;
    helpfulMetrics: HelpfulMetrics;
}

defineProps<Props>()

</script>