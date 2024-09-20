<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\product;

return new class extends Migration
{
    /**
     * _run the migrations.
     */
    public function up(): void
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("category_order_priority")->default(0);

            $table->text('category_img_url')->nullable();
            $table->string('category_name_ua', 255);
            $table->string('category_name_ru', 255);

            $table->string('category_url_ru', 255);
            $table->string('category_url_ua', 255);
            $table->foreignId('category_parent')->nullable();

            $table->string('category_h1_ua', 255);
            $table->string('category_h1_ru', 255);

            $table->text('category_description_tag_ua');
            $table->text('category_description_tag_ru');

            $table->text('category_description_ru');
            $table->text('category_description_ua');
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id("atribute_ID");
            $table->string('atribute_name_ua', 255);
            $table->string('atribute_name_ru', 255);
            // $table->json('atribute_values_ua');
            // $table->json('atribute_values_ru');
            $table->timestamps();
        });
        Schema::create('attributes_values', function (Blueprint $table) {
            $table->id("atribute_value_id");
            $table->bigInteger("atribute_id");
            $table->bigInteger("product_id");
            $table->string('atribute_name_ua', 255);
            $table->string('atribute_name_ru', 255);
            // $table->json('atribute_values_ua');
            // $table->json('atribute_values_ru');
            $table->timestamps();
        });




        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->bigInteger("product_show_country")->default(0);
            $table->bigInteger("product_order_priority")->default(0);
            $table->bigInteger("product_category_id");
            $table->bigInteger("article")->unique()->nullable();
            $table->float('product_price');

            $table->json('product_video_link')->nullable();
            $table->string('product_img_alt_ua', 255);
            $table->string('product_img_alt_ru', 255);
            $table->string('product_best_seller')->default(0);

            $table->float('product_price_discount')->nullable();

            $table->date('product_price_discount_date_starts')->nullable();
            $table->date('product_price_discount_date_expires')->nullable();

            $table->float('product_price_discount_type')->nullable();

            $table->integer('product_avalible_state');
            $table->integer('product_quantity');

            $table->float('product_rating')->default(0);

            $table->string('product_name_ua', 255);
            $table->string('product_name_ru', 255);

            $table->string('product_title_ua', 255);
            $table->string('product_title_ru', 255);

            $table->string('product_url_ua', 255);
            $table->string('product_url_ru', 255);

            $table->text('product_description_ua');
            $table->text('product_description_ru');

            $table->text('product_meta_description_ua');
            $table->text('product_meta_description_ru');


            $table->json('product_reviews')->nullable();

            //реинтерпретация 
            // $table->json('product_attributes_ids')->nullable();

            $table->text('product_tags_ua')->nullable();

            $table->text('product_tags_ru')->nullable();

            $table->json('product_img_urls')->nullable();


            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id("review_id");

            $table->bigInteger("review_user_id");
            $table->string('review_author', 255);
            $table->bigInteger("review_product_id")->default(0);

            $table->text('review_plus');

            $table->text('review_minus');

            $table->text('review_text');

            $table->text('review_admin_answer');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category');
        Schema::dropIfExists('products');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attributes_values');
        Schema::dropIfExists('reviews');
    }
};
