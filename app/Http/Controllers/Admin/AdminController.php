<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
class AdminController extends Controller
{
    //
    public function __construct() {
       $this->middleware('admin');
    }
    public function  index() {
      return view('admin.layouts');
    }
}
