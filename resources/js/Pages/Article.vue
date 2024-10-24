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
            <footer class="flex justify-between">
                <div v-if="previous != null">
                    <p class="font-bold">Previous article</p>
                    <p><Link :href="route('article.view',previous.slug)"></Link></p>
                </div>
                <div v-if="next != null">
                    <p class="font-bold">Next article</p>
                    <p><Link :href="route('article.view',next.slug)"></Link></p>
                </div>
            </footer>
        </template>
    </InnerPageLayout>
</template>


<script setup lang="ts">
import InnerPageLayout from '@/Layouts/InnerPageLayout.vue';
import SidebarNavigation from '@/Components/SidebarNavigation.vue';
import { Article } from '@/types';

interface Props {
    article: Article;
    navigation: Array<Article>;
    previous: Article;
    next: Article;
}

defineProps<Props>()

</script>