<template>
    <Head :title="name + ' Category'"></Head>
    <InnerPageLayout>
        <template #content>
            <article class="prose prose-lg max-w-full prose-a:text-primary-500 prose-a:no-underline hover:prose-a:text-primary-700 hover:prose-a:underline mx-24">
                <h1>{{ name }}</h1>
                <section class="columns-2 gap-8">
                    <ul class="list-none pl-0 my-0" v-if="articles && articles.length > 0">
                        <li v-for="article in articles" :key="article.slug" class="leading-tight py-2 first:pt-0 last:pb-0 break-inside-avoid">
                            <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                        </li>
                    </ul>
                </section>
                <div class="columns-1 sm:columns-auto gap-8">
                    <section v-for="child in children" class="break-inside-avoid grow w-full block">
                        <div v-if="child.articles !== undefined && child.articles.length > 0" class="flex flex-col">
                            <h2>{{ child.name }}</h2>
                            <ul class="list-none pl-0">
                                <li v-for="article in child.articles" :key="article.slug">
                                    <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                                </li>
                            </ul>
                        </div>
                    </section>
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