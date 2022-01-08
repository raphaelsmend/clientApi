<?php
namespace Tests\Traits;

trait DatabaseSeedsOnce
{
    private static $seed = false;
    
    protected function runSeedsOnce()
    {
        if(!self::$seed){
            $this->seed();
            self::$seed = true;
        }
        
    }
}
