<?php
namespace Chatbox\Token\Illuminate\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:22
 */
class TokenFlush extends Command
{
    protected $signature = "token:flush {table} {hour} {--delete} {--count}";

    public function handle(LoggerInterface $logger){
        $table = $this->argument("table");
        $hour = $this->argument("hour");

        $query = \DB::table($table)->where("created_at","<",Carbon::now()->subHour($hour));
        if($this->option("delete")){
            $res = $query->delete();
            $logger->warning("token deleted : $res rows");
        }elseif($this->option("count")){
            $res = $query->count();
            $logger->warning("token count : $res rows");
        }
    }
}