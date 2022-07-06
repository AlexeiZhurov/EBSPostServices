<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда создает Action';

    protected function getFileExample($name,$apiv): string
    {
        $example = 
"<?php
namespace App\Http\ApiV{$apiv}\Action;
// use App\Model\Posts;
class {$name}Action{
        
    public function execute() : void
    {
        //code
    }    
        
}";
        return $example;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : void
    {
        $apiversion = $this->ask('Укажите версию Api');
        $name = $this->ask('Введите название Action');
        $path = "app/Http/ApiV{$apiversion}/Action";
        if(!file_exists($path)){
            mkdir($path, 0700,true);
        }
        $fp = fopen($path."/{$name}Action.php", "w");
	    fwrite($fp, $this->getFileExample($name,$apiversion));
	    fclose($fp);
        $this->info('Действие создано в '.$path);
    }
}
