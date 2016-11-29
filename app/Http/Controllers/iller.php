<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class iller extends Controller
{
    public function index()
	{
		//
		$cities = iller::all();
		return view ('iletisim')->with('cities', $cities);
	}
}
