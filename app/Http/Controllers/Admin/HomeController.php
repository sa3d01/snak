<?php

namespace App\Http\Controllers\Admin;


use App\Setting;
use Illuminate\Http\Request;

class HomeController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view('dashboard.index');
    }
    public function setting(){
        $row = Setting::first();
        return View('dashboard.settings', [
            'row' => $row,
        ]);
    }
    public function update_setting(Request $request){
        $data=$request->all();
        $about['ar']=$request['about_ar'];
        $about['en']=$request['about_en'];
        $licence['ar']=$request['licence_ar'];
        $licence['en']=$request['licence_en'];
        $app_links['android']=$request['android'];
        $app_links['ios']=$request['ios'];
        $data['about']=$about;
        $data['licence']=$licence;
        $data['app_links']=$app_links;
        Setting::updateOrCreate(['id'=>1],$data);
        return redirect()->back()->with('updated', 'تم التعديل بنجاح');
    }

}
