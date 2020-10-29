<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PackageController extends MasterController
{
    public function __construct(Package $model)
    {
        $this->model = $model;
        $this->route = 'package';
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
        $rows = $this->model->all();
        return View('dashboard.index.index', [
            'rows' => $rows,
            'type'=>'package',
            'title'=>'قائمة الباقات',
            'index_fields'=>['الاسم' => 'name','التفاصيل' => 'note','سعر اليوم'=>'price','اللون'=>'color','المدة'=>'period', 'الرقم الترتيبى ' => 'order_by'],
            'images'=>true,
            'languages'=>true,
            'status'=>true,
        ]);
    }

    public function create()
    {
        return View('dashboard.create.create', [
            'type'=>'package',
            'action'=>'admin.package.store',
            'title'=>'أضافة باقة',
            'create_lang_fields'=>['الاسم' => 'name','التفاصيل' => 'note'],
            'create_fields'=>['سعر اليوم'=>'price','اللون'=>'color','الصور'=>'images'],
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
        $note['ar']=$request['note_ar'];
        $note['en']=$request['note_en'];
        $data['note']=$note;
        $images=[];
        foreach ($request->images as $file) {
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move('media/images/package', $filename);
            $images[]=$filename;
        }
        $data['images']=$images;
        $maxValue = $this->model->orderBy('order_by', 'desc')->value('order_by');
        $data['order_by']=$maxValue+1;
        $this->model->create($data);
        return redirect()->route('admin.package.index')->with('created');
    }
    public function update($id,Request $request)
    {
        $this->validate($request, $this->validation_func(2),$this->validation_msg());
        $data=$request->all();
        $name['ar']=$request['name_ar'];
        $name['en']=$request['name_en'];
        $data['name']=$name;
        $note['ar']=$request['note_ar'];
        $note['en']=$request['note_en'];
        $data['note']=$note;
        if ($request->images){
            $images=[];
            foreach ($request->images as $file) {
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move('media/images/package', $filename);
                $images[]=$filename;
            }
            $data['images']=$images;
        }
        $this->model->find($id)->update($data);
        return redirect('admin/' . $this->route . '')->with('updated', 'تم التعديل بنجاح');
    }

    public function show($id)
    {
        $row = Package::findOrFail($id);
        return View('dashboard.show.show', [
            'row' => $row,
            'type'=>'package',
            'action'=>'admin.package.update',
            'title'=>'باقة',
            'edit_fields'=>['سعر اليوم'=>'price','اللون'=>'color','الصور'=>'images'],
            'edit_lang_fields'=>['الاسم' => 'name','التفاصيل' => 'note'],
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
