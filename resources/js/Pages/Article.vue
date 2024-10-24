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
}

defineProps<Props>()

</script>