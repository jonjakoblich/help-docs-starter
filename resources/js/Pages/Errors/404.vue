<template>
    <ErrorPageLayout
        status="404"
        heading="This page does not exist"
        sub-heading="Sorry, we couldn't find the page you are looking for."
    />
</template>

<script setup lang="ts">
import ErrorPageLayout from '@/Layouts/ErrorPageLayout.vue';
</script>