<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';
import ProductHomeLink from './ProductHomeLink.vue';
import { ref } from 'vue';
import SearchModal from './SearchModal.vue';

const currentPath = ref(window.location.href)

const searchModalVisible = ref(false)
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
            <button 
                type="button" 
                class="group flex h-6 w-6 items-center justify-center sm:justify-start md:h-auto md:w-80 md:flex-none md:rounded-lg md:py-2.5 md:pl-4 md:pr-3.5 md:text-sm md:ring-1 md:ring-slate-200 md:hover:ring-slate-300 lg:w-96 dark:md:bg-slate-800/75 dark:md:ring-inset dark:md:ring-white/5 dark:md:hover:bg-slate-700/40 dark:md:hover:ring-slate-500"
                @click="searchModalVisible = !searchModalVisible"
            >
                <svg aria-hidden="true" viewBox="0 0 20 20" class="h-5 w-5 flex-none fill-slate-400 group-hover:fill-slate-500 md:group-hover:fill-slate-400 dark:fill-slate-500">
                    <path d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"></path>
                </svg>
                <span class="sr-only md:not-sr-only md:ml-2 md:text-slate-500 md:dark:text-slate-400">Search support docs</span>
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