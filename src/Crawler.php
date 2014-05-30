<?php

set_time_limit(0);

class Crawler
{
    protected $_db = null;
    protected $_monitoramento = null;

    public $response = null;

    const PRIMARY   = 'monitoramento_id';
    const TERMO     = 'monitoramento_termo';
    const FACEBOOK  = 'monitoramento_rede_facebook';
    const TWITTER   = 'monitoramento_rede_twitter';
    const LINKEDIN  = 'monitoramento_rede_linkedin';
    const INSTAGRAM = 'monitoramento_rede_instagram';

    public function __construct($db)
    {

        $this->setMonitoramentos($db);

        $m = $this->getMonitoramentos();
        $termos = $m->GetResults(null, null, null, false);

        foreach ($termos as $termo)
        {
            $this->filter($termo);
        }

    }

    public function setDatabase($db)
    {
        $this->_db = $db;
    }

    public function getDatabase()
    {
        return $this->_db;
    }

    public function setMonitoramentos($db)
    {
        $this->setDatabase($db);
        $this->_monitoramento = new Monitoramento($this->getDatabase());
    }

    public function getMonitoramentos()
    {
        return $this->_monitoramento;
    }

    public function filter($termo = array())
    {
        if($termo[self::FACEBOOK])
        {
            $this->carry('Facebook', $termo[self::PRIMARY], $termo[self::TERMO]);
        }

        if($termo[self::TWITTER])
        {
            $this->carry('Twitter', $termo[self::PRIMARY], $termo[self::TERMO]);
        }

        if($termo[self::LINKEDIN])
        {
            $this->carry('Linkedin', $termo[self::PRIMARY], $termo[self::TERMO]);
        }

        if($termo[self::INSTAGRAM])
        {
            $this->carry('Instagram', $termo[self::PRIMARY], $termo[self::TERMO]);
        }
    }

    public function carry($rede, $id, $termo)
    {
        //@ TODO getLastRegister()

        $store = $this->_store($rede, $termo);

        var_dump($rede, $id, $termo, $store->getResponse());
    }

    private function _store($classe, $termo)
    {
        $classe = 'Crawler_' . $classe;

        if(class_exists($classe))
        {

            return new $classe($termo);

        }

        return $this;

    }

    public function getResponse()
    {

        // @TODO verificar depois
        if($this instanceof Crawler and is_subclass_of($this, 'Crawler'))
        {

            return $this->response;

        }

        return false;
    }

}