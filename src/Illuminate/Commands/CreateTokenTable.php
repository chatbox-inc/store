<?php
namespace Chatbox\Token\Illuminate\Commands;
use Chatbox\Token\Illuminate\Schema\Tokens;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:22
 */
class CreateTokenTable extends Command
{
    protected $signature = "token:table {table}";

    public function handle(){
        $table = $this->argument("table");
        (new Tokens($table))->up();
    }


}