<?php

use TwitterOAuth\TwitterOAuth;

class Crawler_Twitter extends Crawler
{

    public function __construct($term, $date = false)
    {
        $date or date('Y-m-d');

        $auth = array(
            'consumer_key' => 'KVkrn7uBUMip54GWMUL2gLGT0',
            'consumer_secret' => 'VAX4Au52lyrfHk0NYa0qaKZtzEIoQsNjYXGTfv87LzYgTjBU2a',
            'oauth_token' => '2361267441-osslrEhA6ZBYpa9h5CEPCJR3AI8UooGpwg0uhi4',
            'oauth_token_secret' => 'gaIUmEhOWhkaAcYWScZwSSh28gMo6JeCkm4eeOT8dDMkN',
            'output_format' => 'object'
        );

        $twitter = new TwitterOAuth($auth);

        $params = array(
            'q' => $term,
            'lang' => 'pt-BR',
            'count' => 100,
        );

        $this->response = $twitter->get('search/tweets', $params);

        return $this->response;
    }

}