<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("parent_id")->nullable()->default(0);
            $table->integer("user_id")->unsigned();
            $table->string("url",256)->unique();
            $table->string("title");
            $table->text("description")->nullable();
            $table->integer("posts")->nullable()->default(0);
            $table->boolean("is_published")->dafault("false");
            $table->boolean("is_protected")->dafault("false");
            $table->timestamps();

            $table->index("parent_id");
            $table->index("user_id");
            $table->index("is_protected");
            $table->index("is_published");
            $table->index("posts");
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
