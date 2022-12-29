<p align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-dark.svg">
        <source media="(prefers-color-scheme: light)" srcset="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.svg">
        <img alt="Laravel Wave Logo" src="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.svg" width="400">
    </picture>
    Demo
</p>

🌐 [Go to Application](https://wave.qruto.dev)

## About

Broadcasting the latest tweets with following tags: **#laravel**, **#php**, **#javascript**, **#vuejs**, **#reactjs**, **@reactjs**, **@vuejs**, **@laravelphp**, **@laravelnews**, **@LaravelLinks**, **@LaravelLivewire**, **@Alpine_JS**, **@inertiajs**, **#inertiajs**, **@tailwindcss**, **#tailwindcss**.

Powered by [Laravel Wave](https://github.com/qruto/laravel-wave).

## Source

Default Echo setup in _resources/js/bootstrap.js_:

```js
import Echo from "laravel-echo";

import { WaveConnector } from "laravel-wave";

window.Echo = new Echo({ broadcaster: WaveConnector });
```

New tweets listener in _resources/js/Components/TweetList_:

```js
import { ref } from "vue";

const tweets = ref([]);

window.Echo.channel("twitter-stream").listen("NewTweet", (e) =>
    tweets.value.unshift(e)
);
```

## Installation

```bash
composer install
npm install
npm run dev
```
