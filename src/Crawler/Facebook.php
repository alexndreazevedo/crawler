<?php

class Crawler_Facebook extends Crawler
{

    public function __construct($term, $date = false)
    {

        $auth = array(
            'appId'  => '1446511438910678',
            'secret' => 'e4446a47a612b19e38cd16d9ac122638',
        );

        $facebook = new Crawler_Facebook_Version($auth, '1.0');

        try
        {

            $this->response = $facebook->api('search', 'get', array(
                'q' => $term
            ));

        }
        catch (FacebookApiException $e)
        {
            error_log($e);
        }

        return $this->response;

    }

}