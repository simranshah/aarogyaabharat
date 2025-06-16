<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('author_email');
            $table->enum('topic', [
                'clinical-research',
                'patient-care',
                'public-health',
                'medical-technology',
                'nutrition',
                'other'
            ]);
            $table->string('title');
            $table->text('abstract');
            $table->string('file_path');
            $table->string('status')->default('submitted'); // submitted, under-review, accepted, rejected
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
