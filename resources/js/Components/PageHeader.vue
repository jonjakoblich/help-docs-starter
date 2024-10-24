<script setup lang="ts">
import ApplicationLogo from './ApplicationLogo.vue';
import ProductHomeLink from './ProductHomeLink.vue';
</script>

<template>
    <header class="flex justify-between w-full mx-auto place-items-center py-2">
        <div class="flex place-items-center gap-2">
             <ApplicationLogo class="size-12" />
             <p>Support Center</p>
        </div>
        <div>
            <input type="text" class="rounded-md h-10 border-gray-300 w-96" placeholder="Search support docs..." />
        </div>
        <div>
            <ProductHomeLink />
        </div>
    </header>
</template>