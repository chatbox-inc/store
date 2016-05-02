<?php
namespace Chatbox\Token\Illuminate\Schema;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/05/03
 * Time: 0:01
 */
class Tokens
{


    protected $table;

    /**
     * Credentials constructor.
     * @param $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }


    public function up(){
        Schema::create($this->table,function(Blueprint $blueprint){
            $blueprint->increments("id");
            $blueprint->string("key")->unique();
            $blueprint->text("value");
            $blueprint->timestamp("created_at");

        });
    }

    public function down(){
        Schema::dropIfExists($this->table);
    }

}