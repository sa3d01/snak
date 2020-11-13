<?php

namespace App\Http\Controllers\Admin;

use App\Child;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends MasterController
{
    public function __construct(Child $model)
    {
        $this->model = $model;
        $this->route = 'child';
        parent::__construct();
    }
    public function index()
    {
        $rows = $this->model->all();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'child',
            'title'=>'قائمة  الأطفال',
            'index_fields'=>['الاسم' => 'name','المدرسة'=>'grade_id','المستوى الدراسى'=>'school_id'],
        ]);
    }
    public function childs($id)
    {
        $rows = Child::where('parent_id',$id)->get();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'child',
            'title'=>'قائمة  الأطفال',
            'index_fields'=>['الاسم' => 'name','المدرسة'=>'grade_id','المستوى الدراسى'=>'school_id'],
        ]);
    }
    public function show($id)
    {
        $row = Child::findOrFail($id);
        return View('dashboard.show.show', [
            'row' => $row,
            'type'=>'child',
            'action'=>'admin.child.update',
            'title'=>'الملف الشخصى للطفل',
            'edit_fields'=>['الاسم' => 'name','النوع '=>'gender','تاريخ الميلاد '=>'birth_date','أطعمة مفضلة'=>'child_like','أطعمة ضارة '=>'health_warnings','تفاصيل أخرى'=>'additional_notes'],
            'selects'=>[
                [
                    'name'=>'school',
                    'title'=>'المدرسة'
                ],
                [
                    'name'=>'grade',
                    'title'=>'المستوى الدراسى'
                ],
            ],
            'only_show'=>true,
        ]);
    }
}
