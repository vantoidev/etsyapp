<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use App\Http\Requests\CateRequests;
use App\Cate;

class CateController extends Controller
{
    protected $url = 'https://openapi.etsy.com/v2/';
    protected $api = '?api_key=bxmco9dgbo70ms9frb9uq5jt';
    protected $i = 0;
    protected $j = 0;

    public function getTop() {
        return view('admin.cate.add');
    }

    public function postTop(CateRequests $request) {
        $query  = 'categories/'.$request->txt_cate_name;
        $client = new Client();
        try{
            $res     = $client->request('GET', $this->url.$query.$this->api, ['allow_redirects' => false]);
            $datas   = json_decode($res->getBody(), false);
            foreach($datas->results as $data) {
                $this->syncCate($data);
            }
            return redirect()->route('getCateList')->with(['flash'=>'success', 'messages'=>'The category created successful!']);
        } catch (ClientException $e) {
            return redirect()->route('getCateTop')->with(['flash'=>'danger', 'messages'=>'The category is does not exists!']);
        }
    }

    public function getSub($id) {
        // if(isset($request->cate_name)):
            $cateName = Cate::find($id);
            $query = 'taxonomy/categories/'.$cateName->category_name;
            $client = new Client();
            try {
                $res   = $client->request('GET', $this->url.$query.$this->api, ['allow_redirects' => false]);
                $datas = json_decode($res->getBody(), false);
                $i     = 0;
                $j     = 0;
                foreach($datas->results as $data) {
                    $this->syncCate($data);
                    //echo $data->category_id.'-';
                }
                // return redirect()->route('getCateList')->with(['flash'=>'success', 'messages'=>'Add new '.$this->i.' categories successful & '.$this->j.' categories exists!']);
            } catch(ClientException $e) {
                return redirect()->route('getCateList')->with(['flash'=>'danger', 'messages'=>'This catetegory haven\'t category child!']);
            }
        // else:
        //     return redirect()->route('getCateList')->with(['flash'=>'danger', 'messages'=>'No category selected!']);
        // endif;
    }

    public function getList() {
    	$cates = Cate::all();
    	return view('admin.cate.list', compact('cates'));
    }

    public function getUpdate($id) {
        $cate = Cate::find($id);
        if($cate->status == 1):
            $cate->status = false;
        else:
            $cate->status = true;
        endif;
        $cate->save();
        return redirect()->back()->with(['flash'=>'success', 'messages'=>'Update category '.$cate->short_name.' successful']);
    }

    public function getUpdateAll() {
        $cates = Cate::all();
        foreach($cates as $cate):
            if($cate->status == 1):
                $cate->status = false;
            endif;
            $cate->save();
        endforeach;
        return redirect()->route('getCateList')->with(['flash'=>'success', 'messages'=>'Update category successful']);
    }

    public function getDelete($id) {
        if(Request::ajax()) {
            $cate = Cate::find($id);
            $cate->delete();
            return 'ok';
        }
    }

    public function getInAndActive($id) {
        if(Request::ajax()){
            // $cateID = (int)Request::get('cateID');
            // $cateID = $id;
            $cate = Cate::find($id);
            if($cate->status == 1):
                $cate->status = false;
            else:
                $cate->status = true;
            endif;
            $cate->save();
            return 'ok';
        }
    }

    public function createTopCate($data) {
        $cate                   = new Cate;
        $cate->id               = $data->category_id;
        $cate->name             = $data->name;
        $cate->meta_title       = $data->meta_title;
        $cate->meta_keywords    = $data->meta_keywords;
        $cate->meta_description = $data->meta_description;
        $cate->page_description = $data->page_description;
        $cate->page_title       = $data->page_title;
        $cate->category_name    = $data->category_name;
        $cate->short_name       = $data->short_name;
        $cate->long_name        = $data->long_name;
        $cate->num_children     = $data->num_children;
        $cate->status           = false;
        $cate->save();
        return $cate;
    }

    public function updateCate($data) {
        $cate = Cate::where('id', $data->category_id)->get();
        // $cate->meta_title       = $data->meta_title;
        // $cate->meta_keywords    = $data->meta_keywords;
        // $cate->meta_description = $data->meta_description;
        // $cate->page_description = $data->page_description;
        // $cate->page_title       = $data->page_title;
        // $cate->category_name    = $data->category_name;
        // $cate->short_name       = $data->short_name;
        // $cate->long_name        = $data->long_name;
        // $cate->num_children     = $data->num_children;
        // $cate->save();
        return $cate;
        //echo $cate['name'];
    }

    public function syncCate($data) {
        $found = Cate::where('id', $data->category_id)->first();
        // if($found <> '[]') {
        //     $this->j++;
        //     return $this->updateCate($data);
        // } else {
        //     $this->i++;
        //     return $this->createTopCate($data);
        // }

        echo $found->id;

    }
}
