<template>
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
</template>
