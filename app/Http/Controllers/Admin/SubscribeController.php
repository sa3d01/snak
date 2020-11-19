<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Package;
use App\Subscribe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubscribeController extends MasterController
{
    public function __construct(Subscribe $model)
    {
        $this->model = $model;
        $this->route = 'subscribe';
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        $updated_rows = $this->model->where('status','!=','expired')->where('status','!=','rejected')->get();
        foreach ($updated_rows as $row){
            if (is_array($row->more_details['subscribed_days'])){
                $subscribed_days=$row->more_details['subscribed_days'];
                $latest_day=end($subscribed_days);
                if (Carbon::now()->diffInDays($latest_day,false) < 1){
                    if ($row->status=="approved"){
                        $row->update(['status'=>'expired']);
                    }else{
                        $row->update(['status'=>'rejected']);
                    }
                }
            }
        }
        return View('dashboard.subscribe.index', [
            'rows' => $rows,
            'type'=>'subscribe',
            'title'=>'الاشتراكات',
            'index_fields'=>['ID' => 'id'],
            'selects'=>[
                [
                    'name'=>'child',
                    'title'=>'الطفل'
                ],
                [
                    'name'=>'package',
                    'title'=>'الباقة'
                ],
            ],
            'status'=>true,
        ]);
    }
    public function today()
    {
        $rows = $this->model->where('more_details->subscribed_days','LIKE', '%'.Carbon::now()->format('Y-m-d').'%')->latest()->get();
        return View('dashboard.subscribe.index', [
            'rows' => $rows,
            'type'=>'subscribe',
            'title'=>'الاشتراكات',
            'index_fields'=>['ID' => 'id'],
            'selects'=>[
                [
                    'name'=>'child',
                    'title'=>'الطفل'
                ],
                [
                    'name'=>'package',
                    'title'=>'الباقة'
                ],
            ],
            'status'=>true,
        ]);
    }
    public function tomorrow()
    {
        $rows = $this->model->where('more_details->subscribed_days','LIKE', '%'.Carbon::now()->addDay()->format('Y-m-d').'%')->latest()->get();
        return View('dashboard.subscribe.index', [
            'rows' => $rows,
            'type'=>'subscribe',
            'title'=>'الاشتراكات',
            'index_fields'=>['ID' => 'id'],
            'selects'=>[
                [
                    'name'=>'child',
                    'title'=>'الطفل'
                ],
                [
                    'name'=>'package',
                    'title'=>'الباقة'
                ],
            ],
            'status'=>true,
        ]);
    }


    public function update($id,Request $request)
    {
        $this->validate($request, $this->validation_func(2),$this->validation_msg());
        $data=$request->all();
        $name['ar']=$request['name_ar'];
        $name['en']=$request['name_en'];
        $data['name']=$name;
        $this->model->find($id)->update($data);
        return redirect('admin/' . $this->route . '')->with('updated', 'تم التعديل بنجاح');
    }

    public function show($id)
    {
        $row = Subscribe::findOrFail($id);
        return View('dashboard.subscribe.show', [
            'row' => $row,
            'type'=>'subscribe',
            'action'=>'admin.subscribe.update',
            'title'=>'اشتراك',
            'show_fields'=>[],

            'status'=>true,
        ]);
    }

    public function pay($id){
        $row=$this->model->find($id);
        $row->update([
           'status'=>'approved'
        ]);
        $row->refresh();
        return redirect()->back()->with('updated');
    }
}
