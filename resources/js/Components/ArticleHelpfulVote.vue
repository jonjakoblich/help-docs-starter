<template>
    <section class="flex flex-col place-items-center border-y-gray-100 border-y-2 my-8 gap-4 py-4">
            <p>Was this article helpful?</p>
            <div class="flex gap-2">
                <button class="rounded-md border-2 w-24">Yes</button>
                <button class="rounded-md border-2 w-24">No</button>
            </div>
            <p class="text-sm">{{ metrics.foundHelpful }} out of {{ metrics.totalVotes }} people found this helpful</p>
            <p>Need more help? <Link href="#">Contact us</Link></p>
        </section>
</template>

<script setup lang="ts">
import { HelpfulMetrics } from '@/types';
import { useForm } from '@inertiajs/vue3';

interface Props {
    metrics: HelpfulMetrics
}

const props = defineProps<Props>()

const form = useForm({
    slug: props.metrics.articleSlug,
    vote: null,
})
</script>