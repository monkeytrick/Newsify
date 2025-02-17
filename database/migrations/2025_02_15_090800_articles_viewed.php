<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('articles_viewed', function (Blueprint $table) {
            $table->id();
            $table->string('publication');
            $table->string('country');
            $table->string('title');
            $table->integer('views');
            $table->string('search_type');
        });
    }

    // user clicks on article. Need to check if publication exists in DB. If not add call NewsAPI to find country. Add these 
    // details to publications DB and return ID in table. Add article details to articles viewed and user history (new db need)


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('articles_viewed');
    }
};
