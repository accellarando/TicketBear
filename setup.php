<?php

namespace Accellarando\TicketBear;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Setup{
    public static function run(Event $event){
        $inject = '\<\?php 
            require(__DIR__."/../packages/accellarando/ticketbear/src/helpers.php");';
        $app = __DIR__."/../../../bootstrap/app.php";
        $contents = file($app);
        unset($contents[0]);
        file_put_contents($app,$inject.$file);
    }
}
