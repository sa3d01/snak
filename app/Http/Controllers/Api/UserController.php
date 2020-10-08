<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\User;
use App\userType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class UserController extends MasterController
{
    protected $model;
    protected $auth_key;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->auth_key = 'mobile';
        parent::__construct();
    }
    function send_code($mobile,$activation_code){
        //Mail::to($email)->send(new ConfirmCode($activation_code));
    }
    public function verify_mobile(Request $request){
        $validator = Validator::make(
            $request->all(),
            ['mobile'=>'required|max:11|regex:/(01)[0-9]{9}/'],
            $this->validation_messages())
        ;
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $activation_code = rand(1111, 9999);
        $this->send_code($request['mobile'],$activation_code);
        return $this->sendResponse(['activation_code'=>$activation_code]);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),$this->validation_rules(1),$this->validation_messages());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $all = $request->all();
        $all['password']='123456';

        $user=User::create($all);
        $token=auth()->login($user);
        $data['id']=(int) $user->id;
        $data['name']= $user->name;
        $data['mobile']= $user->mobile;
        $data['email']= $user->email;
        $data['image']= $user->image ?? '';
        $data['type']= $user->type;
        $data['address']= $user->address;
        $data['token']=$token;
        return $this->sendResponse($data)->withHeaders(['apiToken'=>$token,'tokenType'=>'bearer']);
    }
    public function login(Request $request){
        $cred=[
            'mobile'=>$request['mobile'],
            'password'=>'123456'
        ];
        $token=auth()->attempt($cred);
        if ($token){
            $user=auth()->user();
            if ($request->device){
                $user->update([
                    'device'=>[
                        'id'=>$request->device['id'],
                        'type'=>$request->device['type'],
                    ]
                ]);
            }
            $data['id']=(int) $user->id;
            $data['name']= $user->name;
            $data['mobile']= $user->mobile;
            $data['email']= $user->email;
            $data['image']= $user->image ?? '';
            $data['type']= $user->type;
            $data['address']= $user->address;
            $data['token']=$token;
            return $this->sendResponse($data)->withHeaders(['apiToken'=>$token,'tokenType'=>'bearer']);
        } else{
            return $this->sendError('يوجد مشكلة بالبيانات');
        }
    }
    public function logout(Request $request){
        auth()->logout();
        return $this->sendResponse('');
    }

    public function profile(){
        $user = auth()->user();
        $token = auth()->login($user);
        $data= new UserResource($user);
        return $this->sendResponse($data)->withHeaders(['apiToken'=>$token,'tokenType'=>'bearer']);
    }
    public function validation_rules($method,$id = null)
    {
        if ($method==1){
            $rules=[
                'name' => 'required|string|max:100',
                'mobile' => 'regex:/(01)[0-9]{9}/|required|string|max:11|unique:users',
                'email'=>'nullable|email|unique:users',
                'type' => 'required|string|in:Father,Mother',
                'device' => 'required',
            ];
        }else{
            $rules=[
                'name' => 'nullable|string|max:100',
                'mobile' => 'regex:/(01)[0-9]{9}/|nullable|string|max:11|unique:users,mobile,' . $id,
                'email'=>'email|unique:users,email,' . $id,
                'type' => 'required|string|in:Father,Mother',
                'device' => 'required',
            ];
        }
        return $rules;
    }
    public function validation_messages()
    {
        return array(
            'unique' => ' مسجل بالفعل :attribute هذا الـ',
            'required' => ':attribute يجب ادخال الـ',
            'max' =>' يجب أﻻ تزيد قيمته عن :max عناصر :attribute',
            'min' =>' يجب أﻻ تقل قيمته عن :min عناصر :attribute',
            'email'=>'يرجى التأكد من صحة البريد الالكترونى',
            'regex'=>'تأكد من أن رقم الجوال يبدأ 01 , ويحتوى على  احدى عشر رقم'
        );
    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(),$this->validation_rules(2,$id),$this->validation_messages());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $user = auth()->user();
        if ($user->id != $id){
            return $this->sendError('ﻻ يمكنك التعديل بملف شخص اخر',403);
        }
        if ($request->device){
            $user->update([
                'device'=>[
                    'id'=>$request->device['id'],
                    'type'=>$request->device['type'],
                ]
            ]);
        }
        $user->update($request->all());
        $token = auth()->login($user);
        $data['id']=(int) $user->id;
        $data['name']= $user->name;
        $data['mobile']= $user->mobile;
        $data['email']= $user->email;
        $data['image']= $user->image ?? '';
        $data['type']= $user->type;
        $data['address']= $user->address;
        $data['token']=$token;
        return $this->sendResponse($data)->withHeaders(['apiToken'=>$token,'tokenType'=>'bearer']);
    }
    public function update_token($id,Request $request){
        $user = auth()->user();
        if ($user->id != $id){
            return $this->sendError('ﻻ يمكنك التعديل بملف شخص اخر',403);
        }
        if ($request->device){
            $user->update([
                'device'=>[
                    'id'=>$request->device['id'],
                    'type'=>$request->device['type'],
                ]
            ]);
        }
        $token = auth()->login($user);
        $data['id']=(int) $user->id;
        $data['name']= $user->name;
        $data['mobile']= $user->mobile;
        $data['email']= $user->email;
        $data['image']= $user->image ?? '';
        $data['type']= $user->type;
        $data['address']= $user->address;
        $data['token']=$token;
        return $this->sendResponse($data)->withHeaders(['apiToken'=>$token,'tokenType'=>'bearer']);
    }
}
