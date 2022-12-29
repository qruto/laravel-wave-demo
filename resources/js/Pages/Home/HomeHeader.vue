<template>
    <a
        target="_blank"
        href="https://github.com/qruto/laravel-wave"
        class="group block text-center"
    >
        <span
            class="relative left-px top-2 block pl-3 text-xs group-hover:cursor-pointer group-hover:underline dark:text-white"
        >
            Broadcasted with
        </span>
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
    <div class="text-center mt-4">
        <a
            class="block text-blue-500 hover:underline"
            href="https://github.com/qruto/laravel-wave" target="_blank">
            📦 package repo
        </a>
        <a
            class="block mt-2 text-blue-500 hover:underline"
            href="https://github.com/qruto/laravel-wave-demo" target="_blank">
            🌐 demo application repo
        </a>
    </div>
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
</template>
