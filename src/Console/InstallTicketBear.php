<?php

namespace Accellarando\TicketBear\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InstallTicketBear extends Command{
    protected $signature = 'ticketbear:install';
    protected $description = 'Install TicketBear support files';

    private $error;

    public function handle(){
        $this->info('Installing TicketBear...');

        $this->info('Publishing configuration file...');
        if($this->publishConfiguration())
            $this->info("Configuration published.");
        else
            $this->info("Configuration error: ".$this->error);

        $this->info('Bootstrapping helper functions...');
        if($this->publishHelpers())
            $this->info("Helper functions published.");
        else
            $this->info("Helper function installation error: ".$this->error);

        $this->info('Publishing example controllers...');
        if($this->publishControllers())
            $this->info("Controllers published.");
        else
            $this->info("Controller installation error: ".$this->error);

        $this->info('Publishing views...');
        if($this->publishViews())
            $this->info("Views published.");
        else
            $this->info("View installation error: ".$this->error);

        $this->info("Running migrations...");
        $this->call("migrate");

        if(!$this->error)
            $this->info('TicketBear installed successfully!');
        else
            $this->info('TicketBear installed, with errors.');
    }

    private function publishConfiguration(){
        if(file_exists(base_path()."/config/ticketbear.php")){
            if($this->confirm('Configuration file already exists. Overwrite?',false))
                copy(__DIR__."/../files/config.php",base_path()."/config/ticketbear.php");
        }
        else
            copy(__DIR__."/../files/config.php",base_path()."/config/ticketbear.php");
        return file_exists(base_path()."/config/ticketbear.php");
    }

    private function publishHelpers(){
        //Stage 1: copy php file
        if(file_exists(base_path()."/bootstrap/ticketbearHelpers.php")){
            if($this->confirm('Helper functions already exist. Overwrite?',false))
                copy(__DIR__."/../files/helpers.php",base_path()."/bootstrap/ticketbearHelpers.php");
            else
                return true;
        }
        else
            copy(__DIR__."/../files/helpers.php",base_path()."/bootstrap/ticketbearHelpers.php");

        //Stage 2: require it
        $inject = '<?php 
            require("ticketbearHelpers.php");';
        $app = base_path()."/bootstrap/app.php";
        $contents = file($app);
        unset($contents[0]);
        file_put_contents($app,$inject.implode("\n",$contents));

        return file_exists(base_path()."/bootstrap/ticketbearHelpers.php");
    }

    private function publishControllers(){
        if(file_exists(base_path()."/app/Http/Controllers/IssueController.php")){
            if($this->confirm('Controller classes already exist. Overwrite?',false))
                copy(__DIR__."/../files/IssueController.php",base_path()."/app/Http/Controllers/IssueController.php");
        }
        else
            copy(__DIR__."/../files/IssueController.php",base_path()."/app/Http/Controllers/IssueController.php");
        return file_exists(base_path()."/app/Http/Controllers/IssueController.php");
    }

    private function publishViews(){
        $params = ['--provider' => 'Accellarando\TicketBear\TicketBearServiceProvider'];
        $this->call('vendor:publish',$params);
        return true; //idk lol
    }


}
