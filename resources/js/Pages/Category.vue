<template>
    <InnerPageLayout>
        <template #content>
            <article class="prose max-w-full">
                <h1>{{ name }}</h1>
                <ul>
                    <li v-for="article in articles">
                        <Link :href="route('article.view',article.slug)">{{ article.name }}</Link>
                    </li>
                </ul>
            </article>
        </template>
    </InnerPageLayout>

</template>

<script setup lang="ts">
import InnerPageLayout from '@/Layouts/InnerPageLayout.vue';
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<Category>()
</script>