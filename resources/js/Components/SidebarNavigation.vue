<template>
    <nav>
        <ul>
            <li v-for="item in navigation">
                <Link :href="route('article.view',item.slug)">{{ item.name }}</Link>
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