<?php

namespace App\Http\Controllers\Api;

use App\Child;
use App\DropDown;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChildCollection;
use App\Http\Resources\ChildResource;
use App\Http\Resources\DropDownCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\User;
use App\userType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class ChildController extends MasterController
{
    protected $model;

    public function __construct(Child $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    public function index(){
        return $this->sendResponse(ChildCollection::make(Child::where('parent_id',auth()->user()->id)->get()));
    }
    public function show($id){
        return $this->sendResponse(ChildResource::make(Child::find($id)));
    }
    public function school_type(Request $request){
        return $this->sendResponse(DropDownCollection::make(DropDown::active()->where('class','schoolType')->get()));
    }
    public function grades($id){
        return $this->sendResponse(DropDownCollection::make(DropDown::active()->where(['class'=>'schoolGrade','parent_id'=>$id])->get()));
    }
    public function schools($id){
        return $this->sendResponse(DropDownCollection::make(DropDown::active()->where(['class'=>'school','parent_id'=>$id])->get()));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),$this->validation_rules(1),$this->validation_messages());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $data=$request->all();
        try {
            $data['parent_id']=auth()->user()->id;
        }catch (UserNotDefinedException $e){
            return $this->sendError($e->getMessage());
        }
        $child=$this->model->create($data);
        return $this->sendResponse(ChildResource::make($child));
    }
    public function destroy($id){
        $child=Child::find($id);
        if (!$child)
            return $this->sendError('ﻻ يمكن ايجاد هذا العنصر');
        $child->delete();
        return $this->sendResponse('تمت العملية بنجاح');
    }
    public function validation_rules($method,$id = null)
    {
        $rules=[
            'name' => 'required|string|max:100',
            'grade_id' => 'required',
            'school_id' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:Male,Female',
        ];
        return $rules;
    }
    public function validation_messages()
    {
        return array(
            'required' => ':attribute يجب ادخال الـ',
            'max' =>' يجب أﻻ تزيد قيمته عن :max عناصر :attribute',
        );
    }
}
