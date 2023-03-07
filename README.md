<p align="center">
    <picture>
        <source 
            width="350" 
            media="(prefers-color-scheme: dark)"
            srcset="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-dark.png"
        >
        <source
            width="350"
            media="(prefers-color-scheme: light)"
            srcset="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.png"
        >
        <img
            alt="Laravel Wave Logo"
            src="https://github.com/qruto/laravel-wave/raw/HEAD/art/logo-light.png"
            width="350"
        >
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

Broadcasting a simple public event [NewTweet](https://github.com/qruto/laravel-wave-demo/blob/main/app/Events/NewTweet.php) fires.

## Installation

```bash
composer install
npm install
npm run dev
```

Fill twitter API credentials in _.env_ file.

```ini
TWITTER_HANDLE=
TWITTER_API_KEY=
TWITTER_API_SECRET_KEY=
TWITTER_BEARER_TOKEN=
```

Run stream listener:

```bash
php artisan twitter:stream
```
