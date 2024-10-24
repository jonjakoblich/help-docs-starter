<template>
    <nav>
        <h2 class="font-bold">All help documents</h2>
        <ul class="">
            <li v-for="item in navigation" class="my-2">
                <Link :href="route('article.view',item.slug)" class="text-gray-400 hover:cursor-pointer hover:text-indigo-500">{{ item.name }}</Link>
            </li>
        </ul>
    </nav>

</template>

<script setup lang="ts">
import { Article } from '@/types';
import { Link } from '@inertiajs/vue3';

interface Props {
    navigation: Array<Article>;
}

defineProps<Props>()
</script>