<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const tweets = ref([]);

window.Echo.channel("twitter-stream").listen("NewTweet", (e) =>
    tweets.value.unshift(e)
);

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
    <Head title="Laravel Wave Demo" />

    <div
        class="relative flex min-h-screen flex-col items-center justify-center bg-gray-100 px-4 pb-16 pt-12 dark:bg-gray-900"
    >
        <a
            target="_blank"
            href="https://github.com/qruto/laravel-wave"
            class="group block text-center"
        >
            <span
                class="relative left-px top-2 block pl-3 text-xs group-hover:cursor-pointer group-hover:underline dark:text-white"
                >Broadcasted with</span
            >
            <picture>
                <source
                    media="(prefers-color-scheme: dark)"
                    srcset="
                        https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-dark.svg
                    "
                />
                <source
                    media="(prefers-color-scheme: light)"
                    srcset="
                        https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.svg
                    "
                />
                <img
                    alt="Laravel Wave Logo"
                    src="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.svg"
                    width="200"
                />
            </picture>
        </a>
        <div
            class="mt-4 whitespace-pre-wrap text-center text-xs dark:text-white"
        >
            Streaming from Twitter with
            <a
                target="_blank"
                class="font-bold text-blue-500 hover:underline"
                href="https://github.com/spatie/laravel-twitter-streaming-api"
            >
                spatie/laravel-twitter-streaming-api
            </a>
        </div>
        <div
            class="relative mt-8 text-center text-lg italic text-gray-600 dark:text-gray-400"
        >
            Waiting for new tweets from web community<span class="absolute">{{
                dots
            }}</span>
        </div>
        <div class="mt-3 flex flex-col space-y-8">
            <article
                class="block rounded border border-gray-200 py-6 px-4 shadow-lg dark:border-gray-800 sm:px-6"
                v-for="(tweet, index) in tweets"
                :key="index"
            >
                <header class="flex items-center justify-between">
                    <a
                        :href="tweet.user.link"
                        target="_blank"
                        class="flex items-center space-x-2 sm:space-x-4"
                    >
                        <img
                            class="rounded-full"
                            :src="tweet.user.profile_image_url"
                            :alt="tweet.user.name"
                        />
                        <span class="flex flex-col">
                            <span
                                class="text-sm font-bold text-gray-800 dark:text-gray-200 sm:text-base"
                                >{{ tweet.user.name }}</span
                            >
                            <span class="text-xs text-gray-500 sm:text-sm"
                                >@{{ tweet.user.username }}</span
                            >
                        </span>
                    </a>
                    <span
                        class="flex items-center rounded-full bg-blue-200/40 p-2 px-3 text-xs font-bold text-blue-500 dark:bg-blue-200/20"
                        v-if="tweet.isRetweet"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                            class="w-4 fill-current"
                        >
                            <g>
                                <path
                                    d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"
                                ></path>
                            </g>
                        </svg>
                        <span class="pl-1">retweet</span>
                    </span>
                    <span
                        class="flex items-center rounded-full bg-green-200/40 p-2 px-3 text-xs font-bold text-green-500 dark:bg-green-200/20"
                        v-if="tweet.isReply"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                            class="w-4 fill-current"
                        >
                            <g>
                                <path
                                    d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"
                                ></path>
                            </g>
                        </svg>
                        <span class="pl-1">reply</span>
                    </span>
                </header>
                <p
                    class="prose mt-4 prose-a:text-teal-500 dark:prose-invert"
                    v-html="tweet.text"
                ></p>
                <footer class="mt-2 flex justify-end">
                    <a
                        class="text-blue-500 hover:underline"
                        :href="tweet.link"
                        target="_blank"
                        >show on twitter →</a
                    >
                </footer>
            </article>
        </div>
        <footer class="mt-6 text-center text-sm">
            <div class="italic dark:text-gray-400">
                Open the web inspector network tab and try to find
                <span class="font-bold">wave</span> request
            </div>
            <picture>
                <source
                    media="(prefers-color-scheme: dark)"
                    srcset="
                        https://github.com/qruto/laravel-wave/raw/HEAD/art/connection-demo-dark.png
                    "
                />
                <source
                    media="(prefers-color-scheme: light)"
                    srcset="
                        https://github.com/qruto/laravel-wave/raw/HEAD/art/connection-demo-light.png
                    "
                />
                <img
                    alt="Laravel Wave Logo"
                    src="https://github.com/qruto/laravel-wave/raw/HEAD/art/connection-demo-light.png"
                    width="400"
                />
            </picture>
        </footer>
    </div>
</template>
