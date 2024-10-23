<script setup lang="ts">
import ApplicationLogo from './ApplicationLogo.vue';
import ProductHomeLink from './ProductHomeLink.vue';
</script>

<template>
    <header class="flex justify-between w-full mx-auto place-items-center py-1">
        <div>
             <ApplicationLogo class="size-12" />
        </div>
        <div>
            <ProductHomeLink />
        </div>
    </header>
</template>