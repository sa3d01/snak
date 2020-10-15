<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SchoolController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        $this->route = 'School';
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
        $rows = $this->model->whereClass('School')->get();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'School',
            'title'=>'قائمة المدارس والحضانات',
            'index_fields'=>['الاسم' => 'name','المستوى'=>'parent_id'],
            'languages'=>true,
            'status'=>true,
        ]);
    }

    public function create()
    {
        return View('dashboard.create.create', [
            'type'=>'package',
            'action'=>'admin.School.store',
            'title'=>'أضافة مدرسة أو حضانة',
            'create_lang_fields'=>['الاسم' => 'name'],
            'create_fields'=>[],
            'selects'=>[
                [
                    'input_name'=>'parent_id',
                    'rows'=>DropDown::whereClass('SchoolGrade')->get(),
                    'title'=>'المستوى'
                ],
            ],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validation_func(1),$this->validation_msg());
        $data=$request->all();
        $name['ar']=$request['name_ar'];
        $name['en']=$request['name_en'];
        $data['name']=$name;
        $data['class']='School';
        $this->model->create($data);
        return redirect()->route('admin.School.index')->with('created');
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
