<template>
    <section class="flex flex-col place-items-center border-y-gray-100 border-y-2 my-8 gap-4 py-4">
        <div v-if="!voted" class="flex flex-col place-items-center">
            <p>Was this article helpful?</p>
            <div class="flex gap-2">
                <button class="rounded-md border-2 w-24" @click="handleVote(true)">Yes</button>
                <button class="rounded-md border-2 w-24" @click="handleVote(false)">No</button>
            </div>
            <p v-if="form.hasErrors" v-for="error in form.errors" class="text-red-500">{{ error }}</p>
        </div>
        <div v-if="voted">
            <p class="text-emerald-700">Thank you for your vote!</p>
        </div>
        <p class="text-sm">{{ metrics.foundHelpful }} out of {{ metrics.totalVotes }} people found this helpful</p>
        <p>Need more help? <Link href="#" class="text-primary-500 hover:text-primary-700">Contact us</Link></p>
    </section>
</template>

<script setup lang="ts">
import { HelpfulMetrics } from '@/types';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    metrics: HelpfulMetrics
}

interface FormProps {
    vote: boolean|null;
}

const props = defineProps<Props>()

const form = useForm<FormProps>({
    vote: null,
})

const voted = ref(false)

function handleVote(vote: boolean) {
    form.vote = vote

    form.post(route('article.cast-vote', props.metrics.articleSlug),{
        preserveScroll: true,
        onSuccess: () => {
            voted.value = true
        }
    })
}
</script>