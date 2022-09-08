<?php

namespace App\Console\Commands;

use App\Events\NewTweet;
use App\TweetView;
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
            // new Fieldset('backfill_minutes', 3),
        );

        $tags = [
            '#laravel',
            // '#php',
            '#vuejs',
            '#reactjs',
            '@reactjs',
            '@vuejs',
            '@laravelphp',
            '@laravelnews',
            '@LaravelLinks',
            '@LaraconOnline',
            '@LaravelLivewire',
            '@Alpine_JS',
            '@inertiajs',
            '#inertiajs',
            '@tailwindcss',
            '@tailwindui',
            '@pestphp',
            '#tailwindcss',
            // '#html',
            // '#css',
            // '#javascript',
            // '#twitter',
            // '#education',
            // '#public',
        ];

        $users = [
            '92947501', // @spatie_be
            '1159061741164257280', // @pestphp
            '24035747', // @calebporzio
            '1154379830848303105', // @laravellivewire
            // '1096924668009857024', // @inertiajs
            // '895273477711769600', // @tailwindcss
            // '716933677', // @adamwathan
            // '101624176', // @steveschoger
            // '21583', // @davidhemphill
            '17598719', // @reinink
            '20612511', // @jbrooksuk
            '226496901', // @driesvints
            '132971183', // @marcelpociot
            '1475534683', // @enunomaduro
            '10938952', // @gonedark
            '783748047117221888', // @laravellinks
            '97178022', // @freekmurze
            // '2945872888', // @laravelpodcast
            '28870687', // @taylorotwell
            // '14280918', // @stauffermatt
            // '1333339974', // @laracasts
            '301440448', // @laravelphp
            // '920674514', // @laravelio
            '509273832', // @laravelnews
        ];

        $handler = function (array $tweet) {
            // $tweet = (new TweetView($tweet))->render();
            // event($tweet['text']);
            $parser = new Parser();

            ray($tweet);

            $text = $tweet['data']['text'];

            $user = $tweet['includes']['users'][0];
            $isRetweet = false;
            $isReply = false;
            if (Str::startsWith($text, 'RT')) {
                $text = preg_replace('/RT (@.+): /U', '', $text);
                $isRetweet = true;
            }
            $text = nl2br((string) $parser->parse($text));

            $user['link'] = 'https://twitter.com/'.$user['username'];

            if (isset($tweet['data']['in_reply_to_user_id'])) {
                $isReply = true;
            }

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
            // ->whenTweets($users, $handler)
            ->startListening($sets);
    }
}
