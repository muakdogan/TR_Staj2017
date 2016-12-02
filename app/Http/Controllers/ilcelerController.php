<?php

use Input;

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illimunate\Support\Facades\Response;


class ilcelerController extends Controller
{
    public function ajax()
	{
		$city_id = Input::get('city_id');

		$districts = \App\ilceler::where('il_id', '=', $city_id)->get();

		return Response::json($districts);
	}
}