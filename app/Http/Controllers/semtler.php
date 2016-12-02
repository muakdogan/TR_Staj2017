<?php
use Input;
use Illimunate\Support\Facades\Response;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class semtler extends Controller
{
    public function ajaxdistrict()
	{
		$district_id = Input::get('district_id');

		$neighborhoods = \App\semtler::where('ilce_id', '=', $district_id)->get();

		return Response::json($neighborhoods);
	}
        public function ajaxneighborhood()
	{
		$neighborhood_id=Input::get('neighborhood_id');

		$neighborhoods = \App\semtler::where('id', '=', $neighborhood_id)->get();

		return Response::json($neighborhoods);
	}

}
