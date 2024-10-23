<template>
    <InnerPageLayout>
        <template #navigation>
            abc123
        </template>
        <template #content>
            <article class="prose max-w-full">
                <h1>{{ name }}</h1>
                <div v-html="content"></div>
            </article>
        </template>
    </InnerPageLayout>
</template>


<script setup lang="ts">
import InnerPageLayout from '@/Layouts/InnerPageLayout.vue';

defineProps({
    name: String,
    content: String,
})

</script>