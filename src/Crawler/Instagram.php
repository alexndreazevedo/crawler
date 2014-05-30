<?php

class Crawler_Instagram extends Crawler
{

    public function __construct($term, $date = false)
    {
        $client_id = '672965858ef54743adbaf8e040c00894';

        $curl = curl_init();

        $tag = str_replace(' ', '', str_replace('-', '', mb_convert_case(Framework_Texto::translit($term), MB_CASE_LOWER)));

        $url = array(
            'url' => 'https://api.instagram.com/v1/tags/' . $tag . '/media/recent',
            'params' => array(
                'client_id' => $client_id,
            ),
        );

        $options = array(

            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_URL => sprintf( "%s?%s", $url['url'], http_build_query($url['params'])),
            CURLOPT_RETURNTRANSFER => true,

        );

        curl_setopt_array($curl, $options);

        $return = curl_exec($curl);

        $this->response = json_decode($return, true);

        $error	= curl_errno($curl);
        $code	= curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if($error == 0)
        {

            if($code < 400)
            {

                return $this->response;

            }

        }

        return false;

    }

}