<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\PromoCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PromoCodeController extends MasterController
{
    public function __construct(PromoCode $model)
    {
        $this->model = $model;
        $this->route = 'PromoCode';
        parent::__construct();
    }

    public function validation_func($method, $id = null)
    {
        return [
            'code' => 'required',
            'percent' => 'required|numeric',
            'count' => 'required|numeric'
        ];
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
            'type'=>'PromoCode',
            'title'=>'قائمة كوبونات الخصم',
            'index_fields'=>['ID'=>'id','كود الخصم' => 'code','نسبة الخصم %' => 'percent','عدد مرات الاستخدام'=>'count','عدد المرات المستخدمة'=>'used'],
        ]);
    }

    public function create()
    {
        return View('dashboard.create.create', [
            'type'=>'PromoCode',
            'action'=>'admin.PromoCode.store',
            'title'=>'أضافة كوبون خصم',
            'create_fields'=>['كود الخصم' => 'code','نسبة الخصم %' => 'percent','عدد مرات الاستخدام'=>'count'],

        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validation_func(1),$this->validation_msg());
        $data=$request->all();
        $this->model->create($data);
        return redirect()->route('admin.PromoCode.index')->with('created');
    }
    public function update($id,Request $request)
    {
        $this->validate($request, $this->validation_func(2),$this->validation_msg());
        $data=$request->all();
        $this->model->find($id)->update($data);
        return redirect('admin/' . $this->route . '')->with('updated', 'تم التعديل بنجاح');
    }

    public function show($id)
    {
        $row = PromoCode::findOrFail($id);
        return View('dashboard.show.show', [
            'row' => $row,
            'type'=>'PromoCode',
            'action'=>'admin.PromoCode.update',
            'title'=>'كوبون خصم',
            'edit_fields'=>['كود الخصم' => 'code','نسبة الخصم %' => 'percent','عدد مرات الاستخدام'=>'count'],
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
