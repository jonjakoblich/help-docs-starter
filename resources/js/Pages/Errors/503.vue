<template>
    <ErrorPageLayout
        status="503"
        heading="Down for maintenance"
        sub-heading="Sorry! We're down for maintenance right now. Check back in a few minutes."
    />
</template>

<script setup lang="ts">
import ErrorPageLayout from '@/Layouts/ErrorPageLayout.vue';
</script>