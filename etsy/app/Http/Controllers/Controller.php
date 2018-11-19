<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Cate;
use App\Listing;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getDashboard() {
    	$countCates = count(Cate::all());
    	$countListings = count(Listing::all());
    	return view('admin.index', compact('countCates', 'countListings'));
    }
}
