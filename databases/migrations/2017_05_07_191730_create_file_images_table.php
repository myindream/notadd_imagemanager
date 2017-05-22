<?php

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

class CreateFileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!$this->schema->hasTable('file_images'))
        $this->schema->create('file_images', function (Blueprint $table) {
            $table->increments('id')->comment('图片ID');//图片ID
            $table->integer('user_id')->comment('图片上传用户id');//图片上传用户id
            $table->string('path')->comment('图片路径');//图片路径
            $table->string('hash')->comment('图片hash，防重');//图片路径
            $table->tinyInteger('yellow_level')->default(1)->comment('图片见黄级别');//图片鉴黄级别
            $table->tinyInteger('advertisement_level')->default(1)->comment('图片见黄级别');//图片鉴广告级别
            $table->boolean('enabled')->default(true)->comment('是否禁用');//是否禁用。鉴黄级别达不到则需要手动启用
            $table->string('title',64)->nullable()->comment('图片标题');
            $table->softDeletes();
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
        //
        $this->schema->dropIfExists('file_images');
    }
}
