<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("category_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->string("url",256)->unique();
            $table->string("title");
            $table->text("excerpt")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_published")->dafault("false");
            $table->boolean("is_protected")->dafault("false");
            $table->integer("comments")->nullable()->default(0);
            $table->timestamps();
            $table->index("category_id");
            $table->index("user_id");
            $table->index("is_protected");
            $table->index("is_published");
            $table->index("comments");
        });
        Schema::table('blog_posts', function (Blueprint $table) {

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("category_id")->references("id")->on("blog_categories");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
