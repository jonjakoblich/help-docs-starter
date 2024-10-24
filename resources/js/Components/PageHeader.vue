<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';
import ProductHomeLink from './ProductHomeLink.vue';
import { ref } from 'vue';

const currentPath = ref(window.location.href)
</script>

<template>
    <header class="flex justify-between w-full mx-auto place-items-center py-2">
        <div>
            <Link :href="route('home')" class="flex place-items-center gap-2">
             <ApplicationLogo class="size-12" />
             <p>Support Center</p>
            </Link>
        </div>
        <div v-if="currentPath != route('home') + '/'">
            <input type="text" class="rounded-md h-10 border-gray-300 w-96" placeholder="Search support docs..." />
        </div>
        <div>
            <ProductHomeLink />
        </div>
    </header>
</template>