<?php

use App\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('advert_id');
            $table->foreign('advert_id')
                ->references('id')
                ->on('adverts')
                ->onDelete('cascade');

            $table->string('url');
            $table->string('path')->nullable();
            $table->enum('status', [
                Image::PENDING_STATUS,
                Image::READY_STATUS,
                Image::FAILED_STATUS,
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
