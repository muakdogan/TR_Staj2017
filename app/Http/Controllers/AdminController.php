<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Firma;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
    	$firmalar=Firma::all();
    	return view('admin.dashboard')->with('firmalar',$firmalar);
      // "admin.genproduction.index is the new template "Gentelella Aletta". The old one is "admin.dashboard"   "
    }
    public function firmaOnay(Request $request){
        $firma = Firma();
        foreach($request->firmaOnay as $onay)
        //$firma->onay = $request->firmaOnay;
        $onay->save();
        return redirect('/admin');
    }
}
