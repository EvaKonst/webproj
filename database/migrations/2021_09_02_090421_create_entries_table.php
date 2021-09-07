<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->double('wait', 15, 8)->nullable();
            $table->string('request_method')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('response_status')->nullable();
            $table->string('response_status_Text')->nullable();
            $table->bigInteger('response_age')->nullable();
          //  'res_serverLocation'
            $table->bigInteger('request_age')->nullable();
            $table->string('Request_content_type')->nullable();
            $table->string('Request_cache_control')->nullable();
            $table->string('Request_pragma')->nullable();
            $table->string('Request_expires')->nullable();
            $table->string('Request_last_modified')->nullable();
            $table->string('Request_host')->nullable();
            $table->string('startedDateTime')->nullable();
            $table->string('Response_content_type')->nullable();
            $table->string('Response_cache_control')->nullable();
            $table->string('Response_pragma')->nullable();
            $table->string('Response_expires')->nullable();
            $table->string('Response_last_modified')->nullable();
            $table->bigInteger('Response_host')->nullable();

            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
