<?php
namespace Jakjr\Keeper;

use Illuminate\Session\SessionInterface;

class Keeper {

    private $context = null;
    private $session;
    
    function __construct($client=null, SessionInterface $session)
    {
        $this->session = $session;

        if (! is_null($client) ) {
            $this->context = is_object($client) ? get_class($client) : $client;
        }
    }

    private function getContext($passedContext=null)
    {
        if (! is_null($passedContext)) {
            return $passedContext;
        }

        if (! is_null($this->context)) {
            return $this->context;
        }

        throw new \InvalidArgumentException('No context defined');
    }

    public function keep(Array $inputs, $context=null)
    {
        $contextToUse = $this->getContext($context);

        foreach($inputs as $key => $value) {
            $this->session->put("keeper.$contextToUse.$key", $value);
        }
    }

    public function get($key, $context=null)
    {
        $contextToUse = $this->getContext($context);

        return $this->session->get("keeper.$contextToUse.$key");
    }

    public function all($context=null)
    {
        $contextToUse = $this->getContext($context);

        return $this->session->get("keeper.$contextToUse");
    }

}