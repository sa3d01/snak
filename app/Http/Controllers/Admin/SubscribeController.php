<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Package;
use App\Subscribe;
use App\User;
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
        $rows = $this->model->all();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'subscribe',
            'title'=>'الاشتراكات',
            'index_fields'=>['ID' => 'id','تاريخ الطلب'=>'created_at'],
            'selects'=>[
                [
                    'name'=>'child',
                    'title'=>'الطفل'
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
        $row = DropDown::findOrFail($id);
        return View('dashboard.show.show', [
            'row' => $row,
            'type'=>'School',
            'action'=>'admin.School.update',
            'title'=>'مدرسة أو حضانة',
            'edit_fields'=>[],
            'edit_lang_fields'=>['الاسم' => 'name'],
            'status'=>true,
        ]);
    }

    public function activate($id){
        $row=$this->model->find($id);
        if($row->status==1){
            $history[date('Y-m-d')]['block']=[
                'time'=>date('H:i:s'),
                'admin_id'=>Auth::user()->id,
            ];
            $row->update(
                [
                    'status'=>0,
                    'more_details'=>[
                        'history'=>$history,
                    ],
                ]
            );
        }else{
            $history[date('Y-m-d')]['approve']=[
                'time'=>date('H:i:s'),
                'admin_id'=>Auth::user()->id,
            ];
            $row->update(
                [
                    'status'=>1,
                    'more_details'=>[
                        'history'=>$history,
                    ],
                ]
            );
        }
        $row->refresh();
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }
}
