<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->integer('id');
            $table->string('state');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->float('creation_tsz')->nullable();
            $table->float('ending_tsz')->nullable();
            $table->float('original_creation_tsz')->nullable();
            $table->float('last_modified_tsz')->nullable();
            $table->string('price')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sku')->nullable();
            $table->string('tags')->nullable();
            $table->string('category_path')->nullable();
            $table->string('category_path_ids')->nullable();
            $table->integer('taxonomy_id');
            $table->integer('suggested_taxonomy_id');
            $table->string('taxonomy_path')->nullable();
            $table->string('materials')->nullable();
            $table->integer('shop_section_id');
            $table->integer('featured_rank')->nullable();
            $table->float('state_tsz')->nullable();
            $table->string('url')->nullable();
            $table->integer('views')->nullable();
            $table->integer('num_favorers')->nullable();
            $table->integer('shipping_template_id');
            $table->integer('shipping_profile_id');
            $table->integer('processing_min')->nullable();
            $table->integer('processing_max')->nullable();
            $table->enum('who_made', ['i_did', 'collective', 'someone_else'])->nullable();
            $table->boolean('is_supply')->nullable();
            $table->enum('when_made', ['made_to_order', '2010_2018', '2000_2009', '1999_1999', 'before_1999', '1990_1998', '1980s', '1970s', '1960s', '1950s', '1940s', '1930s', '1920s', '1910s', '1900s', '1800s', '1700s', 'before_1700'])->nullable();
            $table->integer('item_weight')->nullable();
            $table->enum('item_weight_unit', ['oz', 'lb', 'g', 'kg'])->nullable();
            $table->integer('item_length')->nullable();
            $table->integer('item_width')->nullable();
            $table->integer('item_height')->nullable();
            $table->enum('item_dimensions_unit', ['in', 'ft', 'mm', 'cm', 'm'])->nullable();
            $table->boolean('is_private')->nullable();
            $table->enum('recipient', ['men', 'women', 'unisex_adults', 'teen_boys', 'teen_girls', 'teens', 'boys', 'girls', 'children', 'baby_boys', 'baby_girls', 'babies', 'birds', 'cats', 'dogs', 'pets', 'not_specified'])->nullable();
            $table->enum('occasion', ['anniversary', 'baptism', 'bar_or_bat_mitzvah', 'birthday', 'canada_day', 'chinese_new_year', 'cinco_de_mayo', 'confirmation', 'christmas', 'day_of_the_dead', 'easter', 'eid', 'engagement', 'fathers_day', 'get_well', 'graduation', 'halloween', 'hanukkah', 'housewarming', 'kwanzaa', 'prom', 'july_4th', 'mothers_day', 'new_baby', 'new_years', 'quinceanera', 'retirement', 'st_patricks_day', 'sweet_16', 'sympathy', 'thanksgiving', 'valentines', 'wedding'])->nullable();
            $table->string('style')->nullable();
            $table->boolean('non_taxable')->nullable();
            $table->boolean('is_customizable')->nullable();
            $table->boolean('is_digital')->nullable();
            $table->string('file_data')->nullable();
            $table->boolean('can_write_inventory')->nullable();
            $table->boolean('has_variations')->nullable();
            $table->boolean('should_auto_renew')->nullable();
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
        Schema::dropIfExists('listings');
    }
}