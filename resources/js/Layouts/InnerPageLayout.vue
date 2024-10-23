<template>
    <MainLayout>
        <PageHeader />
        <div class="flex h-full">
            <div class="w-1/4 h-full bg-gray-100 text-gray-800 p-2">
                <!-- Left column with navigation to pages -->
                 <slot name="navigation"></slot>
            </div>
            <div class="w-3/4 p-8">
                <!-- Right column with content -->
                 <slot name="content"></slot>
            </div>
        </div>
    </MainLayout>
</template>

<script setup lang="ts">
import PageHeader from '@/Components/PageHeader.vue';
import MainLayout from './MainLayout.vue';

</script>