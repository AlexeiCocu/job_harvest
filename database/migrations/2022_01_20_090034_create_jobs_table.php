<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('location');
            $table->text('description');
            $table->text('company');
            $table->text('job_rating');
            $table->timestamps();
        });

        // Because Laravel doesn't support full text search migration
        // Full Text Index
        DB::statement('ALTER TABLE jobs ADD FULLTEXT search(title,location,description,company,job_rating)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('jobs', function($table) {

            $table->dropIndex('search');

        });

        Schema::drop('jobs');

    }
}
