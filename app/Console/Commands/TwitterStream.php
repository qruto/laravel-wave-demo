<?php

namespace App\Console\Commands;

use App\Events\NewTweet;
use DecodeLabs\Chirp\Parser;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use RWC\TwitterStream\Fieldset;
use RWC\TwitterStream\Sets;
use TwitterStreamingApi;

class TwitterStream extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:stream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $sets = new Sets(
            new Fieldset('expansions', 'in_reply_to_user_id', 'author_id', 'attachments.media_keys'),
            new Fieldset('user.fields', 'created_at', 'profile_image_url', 'url', 'username'),
            new Fieldset('media.fields', 'preview_image_url', 'type', 'height', 'width', 'alt_text', 'variants'),
            new Fieldset('tweet.fields', 'entities', 'text', 'created_at'),
        );

        $tags = [
            '#laravel',
            '#php',
            '#javascript',
            '#vuejs',
            '#reactjs',
            '@reactjs',
            '@vuejs',
            '@laravelphp',
            '@laravelnews',
            '@LaravelLinks',
            '@LaravelLivewire',
            '@Alpine_JS',
            '@inertiajs',
            '#inertiajs',
            '@tailwindcss',
            '#tailwindcss',
        ];

        $handler = function (array $tweet) {
            [$text, $user, $isRetweet, $isReply, $tweet] = $this->parseTweet($tweet);

            event(new NewTweet(
                $text,
                $user,
                sprintf('https://twitter.com/%s/status/%s', $tweet['includes']['users'][0]['username'], $tweet['data']['id']),
                $isRetweet,
                $isReply
            ));
        };

        TwitterStreamingApi::publicStream()
            ->whenHears($tags, $handler)
            ->startListening($sets);
    }

    private function parseTweet(array $tweet): array
    {
        $parser = new Parser();

        $text = $tweet['data']['text'];

        $user = $tweet['includes']['users'][0];
        $isRetweet = false;
        $isReply = false;
        if (Str::startsWith($text, 'RT')) {
            $text = preg_replace('/RT (@.+): /U', '', $text);
            $isRetweet = true;
        }
        $text = nl2br((string)$parser->parse($text));

        $user['link'] = 'https://twitter.com/' . $user['username'];

        if (isset($tweet['data']['in_reply_to_user_id'])) {
            $isReply = true;
        }

        return [$text, $user, $isRetweet, $isReply, $tweet];
    }
}
