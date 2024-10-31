<template>
    <div>
      <main class="mx-auto w-full max-w-7xl px-6 pb-16 pt-10 sm:pb-24 lg:px-8">
        <ApplicationLogo class="mx-auto h-16" />
        <div class="mx-auto mt-20 max-w-2xl text-center sm:mt-24">
          <p class="text-3xl font-semibold leading-8 text-primary-500">{{ status }}</p>
          <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ heading }}</h1>
          <p class="mt-4 text-base leading-7 text-gray-600 sm:mt-6 sm:text-lg sm:leading-8">{{ subHeading }}</p>
        </div>
        <div class="mx-auto mt-16 flow-root max-w-lg sm:mt-20" v-if="status != '503'">
          <div class="mt-10 flex justify-center">
            <a href="/" class="text-sm font-semibold leading-6 text-primary-500">
              <span aria-hidden="true">&larr;</span>
              Back to home
            </a>
          </div>
        </div>
      </main>
      <footer class="border-t border-gray-100 py-6 sm:py-10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-center gap-8 px-6 sm:flex-row lg:px-8">
          <div class="hidden sm:block sm:h-7 sm:w-px sm:flex-none sm:bg-gray-200" />
        </div>
      </footer>
    </div>
</template>

<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

interface Props {
    status: String;
    heading: String;
    subHeading: String;
}

defineProps<Props>()
</script>