<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listings';

    protected $fillable = ['id', 'state', 'user_id', 'category_id', 'title', 'description', 'creation_tsz', 'ending_tsz', 'original_creation_tsz', 'last_modified_tsz', 'price', 'currency_code', 'quantity', 'sku', 'tags', 'category_path', 'category_path_ids', 'taxonomy_id', 'taxonomy_path', 'materials', 'shop_section_id', 'featured_rank', 'state_tsz', 'url', 'views', 'num_favorers', 'shipping_template_id', 'processing_min', 'processing_max', 'who_made', 'is_supply', 'when_made', 'item_weight', 'item_weight_unit', 'item_length', 'item_width', 'item_height', 'item_dimensions_unit', 'is_private', 'recipient', 'occasion', 'style', 'non_taxable', 'is_customizable', 'is_digital', 'file_data', 'has_variations', 'should_auto_renew'];

    public $timestamps = true;
}
