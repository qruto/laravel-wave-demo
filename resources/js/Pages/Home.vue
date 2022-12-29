<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import HomeFooter from "@/Pages/Home/HomeFooter.vue";
import HomeHeader from "@/Pages/Home/HomeHeader.vue";
import TweetList from "@/Components/TweetList.vue";

const dots = ref("");

setInterval(() => {
    if (dots.value === "...") {
        dots.value = "";

        return;
    }

    dots.value = dots.value + ".";
}, 500);
</script>

<template>
    <Head title="Laravel Wave Tweets" />

    <div
        class="relative flex min-h-screen flex-col items-center justify-center bg-gray-100 px-4 pb-16 pt-12 dark:bg-gray-900"
    >
        <HomeHeader />
        <div
            class="relative mt-8 text-center text-lg italic text-gray-600 dark:text-gray-400"
        >
            Waiting for new tweets from web community<span class="absolute">{{
                dots
            }}</span>
        </div>
        <TweetList />
        <HomeFooter />
    </div>
</template>
