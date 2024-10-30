<template>
    <Head :title="name + ' Category'"></Head>
    <InnerPageLayout>
        <template #content>
            <article class="prose max-w-full columns-2">
                <h1>{{ name }}</h1>
                <ul class="break-inside-avoid">
                    <li v-for="article in articles">
                        <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                    </li>
                </ul>
                <div v-for="child in children">
                    <div v-if="child.articles !== undefined && child.articles.length > 0">
                        <h2>{{ child.name }}</h2>
                        <ul class="break-inside-avoid">
                            <li v-for="article in child.articles">
                                <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </template>
    </InnerPageLayout>

</template>

<script setup lang="ts">
import InnerPageLayout from '@/Layouts/InnerPageLayout.vue';
import { Category } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

defineProps<Category>()
</script>