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

    public function list($type)
    {
        if ($type=='nursery'){
            $rows = $this->model->whereClass('School')->where('parent_id',1)->orderBy('order_by','asc')->get();
            $title='قائمة الحضانات';
        }else{
            $rows = $this->model->whereClass('School')->where('parent_id',2)->orderBy('order_by','asc')->get();
            $title='قائمة المدارس';
        }
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'School',
            'title'=>$title,
            'index_fields'=>['الاسم' => 'name','المستوى'=>'parent_id', 'الرقم الترتيبى ' => 'order_by'],
            'languages'=>true,
            'status'=>true,
        ]);
    }
    public function index()
    {
        $rows = $this->model->whereClass('School')->orderBy('order_by','asc')->get();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'School',
            'title'=>'قائمة المدارس والحضانات',
            'index_fields'=>['الاسم' => 'name','المستوى'=>'parent_id', 'الرقم الترتيبى ' => 'order_by'],
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
                    'rows'=>DropDown::whereClass('SchoolType')->get(),
                    'title'=>'النوع'
                ],
            ],
            'order_by'=>true,
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
        $maxValue = $this->model->whereClass('School')->orderBy('order_by', 'desc')->value('order_by');
        $data['order_by']=$maxValue+1;
        $this->model->create($data);
        if ($request['parent_id']=='1'){
            return redirect()->route('admin.School.list',['type'=>'nursery'])->with('created');
        }
        return redirect()->route('admin.School.list',['type'=>'school'])->with('created');
    }
    public function update($id,Request $request)
    {
        $this->validate($request, $this->validation_func(2),$this->validation_msg());
        $data=$request->all();
        $name['ar']=$request['name_ar'];
        $name['en']=$request['name_en'];
        $data['name']=$name;
        $row=$this->model->find($id);
        $row->update($data);
        if ($row->parent_id=='1'){
            return redirect()->route('admin.School.list',['type'=>'nursery'])->with('updated', 'تم التعديل بنجاح');
        }
        return redirect()->route('admin.School.list',['type'=>'school'])->with('updated', 'تم التعديل بنجاح');
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
            'order_by'=>true,
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
