<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BreakController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        $this->route = 'Break';
        parent::__construct();
    }

    public function validation_func($method, $id = null)
    {
        return ['name_ar' => 'required','name_en' => 'required'];
    }

    public function validation_msg()
    {
        return array(
            'required' => 'يجب ملئ جميع الحقول',
        );
    }

    public function index()
    {
        $rows = $this->model->whereClass('Break')->get();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'Break',
            'title'=>'قائمة مواعيد التوصيل',
            'index_fields'=>['الاسم' => 'name'],
            'languages'=>true,
            'status'=>true,
        ]);
    }

    public function create()
    {
        return View('dashboard.create.create', [
            'type'=>'package',
            'action'=>'admin.Break.store',
            'title'=>'أضافة ميعاد',
            'create_lang_fields'=>['الاسم' => 'name'],
            'create_fields'=>[],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validation_func(1),$this->validation_msg());
        $data=$request->all();
        $name['ar']=$request['name_ar'];
        $name['en']=$request['name_en'];
        $data['name']=$name;
        $data['class']='Break';
        $this->model->create($data);
        return redirect()->route('admin.Break.index')->with('created');
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
            'type'=>'Break',
            'action'=>'admin.Break.update',
            'title'=>'ميعاد',
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
