<template>
    <nav>
        <ul class="flex flex-col gap-4">
            <li v-for="category in navigation">
                <h2 class="font-bold">
                    <Link :href="route('category.view', category.slug)" class="text-gray-900">{{ category.name }}</Link>
                </h2>
                <ul role="navigation">
                    <li v-for="article in category.articles" class="my-2">
                        <Link 
                            v-if="route('article.view', article.slug) != url"
                            :href="route('article.view', article.slug)" 
                            class="text-gray-400 hover:cursor-pointer hover:text-primary-500"
                        >{{ article.name }}</Link>
                        <p v-if="route('article.view', article.slug) == url">{{ article.name }}</p>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

</template>

<script setup lang="ts">
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';

interface Props {
    navigation: Array<Category>;
}

defineProps<Props>()

const url = window.location.href
</script>