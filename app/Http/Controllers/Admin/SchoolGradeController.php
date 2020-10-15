<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SchoolGradeController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        $this->route = 'SchoolGrade';
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
        $rows = $this->model->whereClass('SchoolGrade')->get();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'SchoolGrade',
            'title'=>'قائمة المستويات الدراسية',
            'index_fields'=>['الاسم' => 'name','النوع'=>'parent_id'],
            'languages'=>true,
            'status'=>true,
        ]);
    }

    public function create()
    {
        return View('dashboard.create.create', [
            'type'=>'package',
            'action'=>'admin.SchoolGrade.store',
            'title'=>'أضافة مستوى دراسى',
            'create_lang_fields'=>['الاسم' => 'name'],
            'create_fields'=>[],
            'selects'=>[
                [
                    'input_name'=>'parent_id',
                    'rows'=>DropDown::whereClass('SchoolType')->get(),
                    'title'=>'النوع'
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
        $data['class']='SchoolGrade';
        $this->model->create($data);
        return redirect()->route('admin.SchoolGrade.index')->with('created');
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
            'type'=>'SchoolGrade',
            'action'=>'admin.SchoolGrade.update',
            'title'=>'مستوى دراسى',
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
