<?php

namespace Utility;

class FlashBag { 

    protected $messages;

    public function __construct(){
        $this->messages = array();
    }

    public function addMessage($type, $message){ 
        if (!array_search($message, $this->getMessages())){
            $this->messages[$type] = $message;
        }
        return $this;
    }

    public function getMessages(){ 
        return $this->messages;
    }

    public function clear(){
        foreach($this->getMessages() as $k => $m) {
            unset($this->messages[$k]);
        }
    }
}
