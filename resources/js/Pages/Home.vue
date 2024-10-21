<template>
    <header class="flex justify-between">
        <div>
            <!-- Company logo -->
        </div>
        <div>
            <!-- Link back to product homepage -->
        </div>
    </header>
    <div class="">
        <h1>Help is only a click away</h1>
        <form>
            <input type="text" />
        </form>
    </div>
    <div class="grid grid-cols-3">
        <!-- Pinned Categories -->
    </div>
     <div>
         <!-- Pinned/Frequent Articles -->
     </div>
</template>

<script setup lang="ts">
import {useForm} from '@inertiajs'

defineProps([
    pinnedCategories: Array,
    pinnedArticles: Array,
])

const searchForm = useForm({
    keywords: ''
})
</script>