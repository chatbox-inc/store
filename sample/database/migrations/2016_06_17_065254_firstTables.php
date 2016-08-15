<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;

class FirstTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::getFacadeRoot();
        (new \App\Model\SimpleDB())->upTable($builder);
        (new \App\Model\Eloquent())->upTable($builder);
        (new \App\Model\TaggableEloquent())->upTable($builder);
        (new \App\Model\TaggableDB())->upTable($builder);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::getFacadeRoot();

        (new \App\Model\SimpleDB())->downTable($builder);
        (new \App\Model\Eloquent())->downTable($builder);
        (new \App\Model\TaggableEloquent())->downTable($builder);
        (new \App\Model\TaggableDB())->downTable($builder);
    }
}
