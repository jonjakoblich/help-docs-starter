<template>
    <div class="fixed inset-0 z-50 mx-auto" @click="(e) => maybeCloseModal(e)" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur" ></div>
        <div class="fixed inset-0 overflow-y-auto px-4 py-4 sm:px-6 sm:py-20 md:py-32 lg:px-8 lg:py-[15vh]">
            <div id="searchModal" class="flex flex-col p-3 mx-auto transform-gpu overflow-hidden rounded-xl bg-white shadow-xl sm:max-w-xl dark:bg-slate-800 dark:ring-1 dark:ring-slate-700">
                <div class="flex place-items-center gap-1">
                    <svg aria-hidden="true" viewBox="0 0 20 20" class="pointer-events-none h-full w-5 fill-slate-400 dark:fill-slate-500">
                        <path d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"></path>
                    </svg>
                    <input
                        v-model="keywords"
                        type="text" 
                        class="border-0 w-full text-xl h-12 focus:ring-0"
                        placeholder="Search support docs..."
                        @input="search"
                        autofocus
                        tabindex="0"
                    />
                </div>
                <div v-if="results != undefined" class="px-2 mt-2">
                    <h2 class="font-bold text-sm text-gray-500">Search Results</h2>
                    <ul v-if="results.length > 0">
                        <li v-for="article in results" class="py-2 text-lg">
                            <Link :href="route('article.view',article.slug)" class="text-indigo-500 hover:text-indigo-700">{{ article.name }}</Link>
                        </li>
                    </ul>
                    <p v-if="results.length == 0" class="py-2">No results could be found</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Article } from '@/types';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const emit = defineEmits(['closeModal'])

const keywords = ref('')
const results = ref<Array<Article>>()

const search = () => {
    if(keywords.value == '') {
        results.value = undefined
    }

    if(keywords.value != '') {
        axios
            .post(route('search.retrieve'),{
                s: keywords.value
            })
            .then((res) => {
                //console.log(res)
                results.value = res.data
            })
            .catch((err) => console.error(err))
    }
}

function maybeCloseModal(e: Event) {
    if(!e.target?.closest('#searchModal')) {
        emit('closeModal')
    }
}
</script>