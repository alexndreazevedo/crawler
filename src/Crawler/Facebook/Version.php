<?php

class Crawler_Facebook_Version extends Facebook
{

    public function __construct($config = array(), $version = '2.0')
    {

        $version_dir = 'v' . $version . '/';

        self::$DOMAIN_MAP = array_merge(parent::$DOMAIN_MAP, array(
            'graph'       => 'https://graph.facebook.com/' . $version_dir,
        ));

        parent::__construct($config);
        
    }

}
