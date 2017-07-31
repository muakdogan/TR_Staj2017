<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Http\Controllers\Controller;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB as DB;
use Session;

class ActivityController extends Controller
{
    public function index()
    {
        $latestActivities = Activity::with('user')->latest()->limit(100)->get();
        return view('admin.kullaniciLog', array('latestActivities' => $latestActivities));

        Activity::log('yaptım oldu');
    }

    public function destroy($id)
    {
        $idea = Activity::findOrFail($id);
        $idea->delete();
        DB::table('activity_log')->where('id'
        , '=', $id)->delete();

        Session::flash('flash_message', 'Activity successfully deleted!');
        return redirect()->route('kullaniciLog.index');
    }

}
