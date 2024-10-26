<template>
    <header class="flex justify-between w-full mx-auto place-items-center py-2">
        <div>
            <Link :href="route('home')" class="flex place-items-center gap-2">
             <ApplicationLogo class="size-12" />
             <p>Support Center</p>
            </Link>
        </div>
        <div v-if="currentPath != route('home') + '/'">
            <button 
                type="button" 
                class="group flex h-6 w-6 items-center justify-center sm:justify-start md:h-auto md:w-80 md:flex-none md:rounded-lg md:py-2.5 md:pl-4 md:pr-3.5 md:text-sm md:ring-1 md:ring-gray-200 md:hover:ring-gray-300 lg:w-96"
                @click="searchModalVisible = !searchModalVisible"
            >
                <MagnifyingGlass />
                <span class="sr-only md:not-sr-only md:ml-2 md:text-gray-500">Search support docs</span>
            </button>
            <Teleport to="body">
                <SearchModal 
                    v-if="searchModalVisible" 
                    @close-modal="searchModalVisible = false"
                />
            </Teleport>
        </div>
        <div>
            <ProductHomeLink />
        </div>
    </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';
import ProductHomeLink from './ProductHomeLink.vue';
import { ref } from 'vue';
import SearchModal from './SearchModal.vue';
import MagnifyingGlass from './Icons/MagnifyingGlass.vue';

const currentPath = ref(window.location.href)

const searchModalVisible = ref(false)
</script>
