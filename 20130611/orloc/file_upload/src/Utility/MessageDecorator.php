<?php 

namespace Utility;

class MessageDecorator {
    
    protected $flashBag;

    public function __construct(FlashBag $flashBag){ 
        $this->flashBag = $flashBag;    
    }

    public function displayMessages(){ 
        if (count($this->flashBag->getMessages()) > 0){
            foreach ($this->flashBag->getMessages() as $k => $m){
                echo trim("
                <div class='{$this->findType($k)}'>
                    $m
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                </div>
                ");
            }

            $this->flashBag->clear();
        }
    }

    public function findType($message){
        $alerts = array (
            'success' => 'alert alert-success',
            'error' => 'alert alert-error',
            'info' => 'alert alert-info'
            );

        if (isset($alerts[$message])){
            return $alerts[$message];
        }
    }
}
