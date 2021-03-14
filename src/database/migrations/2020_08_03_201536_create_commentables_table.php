<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('comment.table_name', 'commentables'), function (Blueprint $table) {

            if (config('comment.uuid', true)) {
                $table->uuid('id')->primary();
                $table->nullableUuidMorphs('commentable');
                $table->uuid('comment_id')->nullable();
            } else {
                $table->id();
                $table->nullableMorphs('commentable');
                $table->unsignedBigInteger('comment_id')->nullable();
            }

            if (config('user.uuid', true)) {
                $table->uuid('user_id')->nullable();
            } else {
                $table->bigIncrements('user_id')->nullable();
            }
            $table->text('comment')->nullable();
            $table->boolean('active')->default(config('comment.default_active', true));
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('comment.table_name', 'commentables'));
    }
}
