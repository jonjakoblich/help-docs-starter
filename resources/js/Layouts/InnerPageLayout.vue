<template>
    <MainLayout>
        <PageHeader />
        <div class="flex h-full">
            <div v-if="$slots.navigation" class="w-1/4 bg-gray-100 text-gray-800 p-8">
                <!-- Left column with navigation to pages -->
                 <slot name="navigation"></slot>
            </div>
            <div class="p-8" :class="{'w-full': $slots.navigation === null, 'w-3/4': $slots.navigation !== null}">
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