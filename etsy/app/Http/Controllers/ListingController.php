<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use App\Listing;
use App\Cate;
use App\Sale;
use Image;

class ListingController extends Controller
{
	protected $url = 'https://openapi.etsy.com/v2/';
    protected $api = 'api_key=bxmco9dgbo70ms9frb9uq5jt';
    protected $i = 0;
    protected $j = 0;

    function getList() {
    	$listings = Listing::all();
    	return view('admin.listing.list', compact('listings'));
    }

    function getListing() {
    	$cates = Cate::where('status', 1)->get();
    	return view('admin.listing.add', compact('cates'));
    }

    function postListing(Request $request) {
    	if(isset($request->sl_category_name)):
    		$cate_name = $request->sl_category_name;
    		$cate_page = isset($request->page) ? $request->page : 1;
            $query = 'listings/active?category='.$cate_name.'&page='.$cate_page.'&limit=100&';
            //echo $query;
            $client = new Client();
            try {
                $res = $client->request('GET', $this->url.$query.$this->api, ['allow_redirects' => false]);
                $datas = json_decode($res->getBody(), false);
                foreach($datas->results as $data) {
                    $this->syncListing($data);
                    //echo $data->listing_id;
                }
                return redirect()->route('getListingList')->with(['flash'=>'success', 'messages'=>'Add new '.$this->i.' listings successful & '.$this->j.' listings updated!']);
            } catch(ClientException $e) {
                return redirect()->route('getListingList')->with(['flash'=>'danger', 'messages'=>'This catetegory doesn\'t exist!']);
            }
        else:
            return redirect()->route('getListing')->with(['flash'=>'danger', 'messages'=>'No category name selected!']);
        endif;
    }

    function updateListing($data) {
    	$listing = Listing::where('id', $data->listing_id)->get();
    	if(property_exists($data, 'price')){
		$listing->price 		= $data->price;
		}else{
		$listing->price 		= NULL;
		}
		if(property_exists($data, 'quantity')){
		$listing->quantity      = $data->quantity;
		}else{
		$listing->quantity      = NULL;
		}
		if(property_exists($data, 'featured_rank')){
		$listing->featured_rank = $data->featured_rank;
		}else{
		$listing->featured_rank = NULL;	
		}
		$listing->views         = $data->views;
		$listing->num_favorers  = $data->num_favorers;
    	$listing->save();
    	$this->updateSale($data);
    	return $listing;
    }

    function createListing($data) {
		$listing                        = new Listing;
		$listing->id                    = $data->listing_id;
		$listing->state                 = $data->state;
		if(property_exists($data, 'user_id')){
		$listing->user_id               = $data->user_id;
		}else{
		$listing->user_id               = NULL;
		}
		if(property_exists($data, 'category_id')){
		$listing->category_id           = $data->category_id;
		}else{
		$listing->category_id           = NULL;
		}
		if(property_exists($data, 'title')){
		$listing->title                 = $data->title;
		}else{
		$listing->title                 = NULL;
		}
		// $listing->description        = $data->description;
		if(property_exists($data, 'creation_tsz')){
		$listing->creation_tsz          = $data->creation_tsz;
		}else{
		$listing->creation_tsz          = NULL;
		}
		$listing->ending_tsz            = $data->ending_tsz;
		$listing->original_creation_tsz = $data->original_creation_tsz;
		$listing->last_modified_tsz     = $data->last_modified_tsz;
		if(property_exists($data, 'price')){
		$listing->price                 = $data->price;
		}else{
		$listing->price                 = NULL;
		}
		$listing->currency_code         = $data->currency_code;
		$listing->quantity              = $data->quantity;
		$listing->sku                   = json_encode($data->sku);
		$listing->tags                  = json_encode($data->tags);
		$listing->category_path         = json_encode($data->category_path);
		$listing->category_path_ids     = json_encode($data->category_path_ids);
		if(property_exists($data, 'taxonomy_id')){
		$listing->taxonomy_id           = $data->taxonomy_id;
		}else{
		$listing->taxonomy_id           = NULL;
		}
		$listing->taxonomy_path         = json_encode($data->taxonomy_path);
		$listing->materials             = json_encode($data->materials);
		$listing->shop_section_id       = $data->shop_section_id;
		$listing->featured_rank         = $data->featured_rank;
		$listing->state_tsz             = $data->state_tsz;
		$listing->url                   = $data->url;
		$listing->views                 = $data->views;
		$listing->num_favorers          = $data->num_favorers;
		$listing->shipping_template_id  = $data->shipping_template_id;
		$listing->processing_min        = $data->processing_min;
		$listing->processing_max        = $data->processing_max;
		$listing->who_made              = $data->who_made;
		$listing->is_supply             = $data->is_supply;
		$listing->when_made             = $data->when_made;
		$listing->item_weight           = $data->item_weight;
		$listing->item_weight_unit      = $data->item_weight_unit;
		$listing->item_length           = $data->item_length;
		$listing->item_width            = $data->item_width;
		$listing->item_height           = $data->item_height;
		$listing->item_dimensions_unit  = $data->item_dimensions_unit;
		$listing->is_private            = $data->is_private;
		$listing->recipient             = $data->recipient;
		$listing->occasion              = $data->occasion;
		$listing->style                 = json_encode($data->style);
		$listing->non_taxable           = $data->non_taxable;
		$listing->is_customizable       = $data->is_customizable;
		$listing->is_digital            = $data->is_digital;
		$listing->file_data             = $data->file_data;
		$listing->has_variations        = $data->has_variations;
		$listing->should_auto_renew     = $data->should_auto_renew;
		$listing->save();
		$this->createSale($data);
		return $listing;
    }

    function updateSale($data) {
    	$listing = Listing::where('id', $data->listing_id)->get();
    	$sale = new Sale;
    	$sale->listing_id = $data->listing_id;
		$sale->number_sale = $listing->quantity - $data->quantity;
		$sale->save();
		return $sale;
    }

    function createSale($data) {
    	$sale = new Sale;
    	$sale->listing_id = $data->listing_id;
		$sale->number_sale = 0;
		$sale->save();
		return $sale;
    }

    function syncListing($data) {
    	$found = Listing::where('id', $data->listing_id)->get();
    	if(!empty($found)) {
    		$this->j++;
    		return $this->updateListing($data);
    	} else {
    		$this->i++;
    		return $this->createListing($data);
    	}
    }

    function getImage() {
  //   	$path = 'https://i.etsystatic.com/11153948/r/il/12af9e/1679631444/il_fullxfull.1679631444_s6o6.jpg';
		// $filename = basename($path);
		// Image::make($path)->save(public_path('resources/upload/listing/' . $filename));

		$url_image = "https://i.etsystatic.com/11153948/r/il/12af9e/1679631444/il_fullxfull.1679631444_s6o6.jpg";

		$dir = "http://localhost/etsy/resources/upload/listing/"; /*khai báo thư mục cần lưu*/

		$img_info=file_get_contents($url_image);

		file_put_contents($dir.substr($url_image, strrpos($url_image,'/')), $img_info); /* Dòng này là lưu ảnh vào thư mục*/
    }
}