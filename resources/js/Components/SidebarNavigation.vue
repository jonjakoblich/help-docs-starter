<template>
    <nav>
        <ul class="flex flex-col gap-4">
            <li v-for="category in navigation">
                <h2 class="font-bold">{{ category.name }}</h2>
                <ul role="navigation">
                    <li v-for="article in category.articles" class="my-2">
                        <Link :href="route('article.view', article.slug)" class="text-gray-400 hover:cursor-pointer hover:text-primary-500">{{ article.name }}</Link>
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
</script>