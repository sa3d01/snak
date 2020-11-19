<?php

namespace App\Http\Controllers\Api;

use App\Child;
use App\DropDown;
use App\Http\Resources\DropDownCollection;
use App\Http\Resources\PackageResource;
use App\Package;
use App\PromoCode;
use App\Setting;
use App\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends MasterController
{
    protected $model;

    public function __construct(Subscribe $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    public function validation_rules($method,$id = null)
    {
        return $rules=[
            'child_id' => 'required',
            'package_id' => 'required',
            'break_id' => 'required',
            'days' => 'required|array',
        ];
    }
    public function validation_messages()
    {
        return array(
            'required' => ':attribute يجب ادخال الـ',
        );
    }
    //functions
    function current_subscribe($child_id){
        return Subscribe::where(['child_id'=>$child_id])->latest()->first();
    }
    function subscribe_price($subscribe){
        $package=Package::find($subscribe->package_id);
        $real_price=$package->price*(count($subscribe->more_details['subscribed_days']));
        $price=$real_price;
        $discount=0;
        $promo_code=PromoCode::find($subscribe->promo_code_id);
        if ($promo_code){
            $percent=(int)$promo_code->percent;

            $discount=$real_price*$percent/100;
            if ($discount>100){
                $discount=100;
            }
            $price=$real_price-($discount);
        }
        return [
            'real_price'=>$real_price,
            'price'=>$price,
            'discount'=>$discount,
        ];
    }
    function subscribed_days_list($subscribe){
        $now=Carbon::now();
        $subscribed_days=[];
        foreach ($subscribe->more_details['subscribed_days'] as $subscribed_day){
            $subscribed_days_obj['status']=false;
            if ($subscribed_day <= $now ){
                $subscribed_days_obj['status']=true;
            }
            $subscribed_days_obj['day']=$subscribed_day;
            $subscribed_days[]=$subscribed_days_obj;
        }
        return $subscribed_days;
    }
    function subscribedDaysInPeriod($subscribe_days,$package_period,$standby_days){
        $begin = Carbon::now()->addDays(1+$standby_days);
        $end = Carbon::now()->addDays(1+$standby_days+$package_period);
        $selected_days=[];
        for($date = $begin; $date <= $end; $date->addDays(1)){
            foreach ($subscribe_days as $subscribe_day){
                if ($subscribe_day==$date->format('l')) {
                    $selected_days[]=$date->format('Y-m-d') ;
                }
            }
        }
        return $selected_days;
    }
    //methods
    public function break_list(){
        return $this->sendResponse(DropDownCollection::make(DropDown::active()->where('class','Break')->orderBy('order_by','asc')->get()));
    }
    public function subscribe_data(Request $request){
        $standby_days=Setting::value('standby_days');
        $package=Package::find($request['package_id']);
        $package_period=$package->period;
        //sat.sun,...
        $subscribe_days=$request['days'];
        $subscribed=Subscribe::where('child_id',$request['child_id'])->where('status','!=','pending')->first();
        if ($subscribed){
            $subscribed_days=$this->subscribedDaysInPeriod($subscribe_days,$package_period,0);
        }else{
            $subscribed_days=$this->subscribedDaysInPeriod($subscribe_days,$package_period,$standby_days);
        }
        $last_subscribed_days=[];
        foreach ($subscribed_days as $subscribed_day){
            $last_subscribed_days_obj['status']=false;
            if ($subscribed_day <= Carbon::now() ){
                $last_subscribed_days_obj['status']=true;
            }
            $last_subscribed_days_obj['day']=$subscribed_day;
            $last_subscribed_days[]=$last_subscribed_days_obj;
        }

//        if (($package->period>=30) && (count($subscribed_days)<11)){
//            return $this->sendError('الحد الأدنى هو عشرة أيام فى هذه الباقة');
//        }elseif (($package->period <= 7) && (count($subscribed_days) < 3)){
//            return $this->sendError('الحد الأدنى هو ثلاثة أيام فى هذه الباقة');
//        }

        $subscribe_price['real_price']=$package->price*(count($subscribed_days));
        $subscribe_price['price']=$package->price*(count($subscribed_days));
        $subscribe_price['discount']=0;
        $promo_code=PromoCode::find($request->promo_code_id);
        if ($promo_code){
            $percent=(int)$promo_code->percent;
            $discount=$subscribe_price['real_price']*$percent/100;
            if ($discount > 100){
                $discount=100;
            }
            $subscribe_price['price']=$subscribe_price['real_price']-($discount);
            $subscribe_price['discount']=$discount;
        }
        return $this->sendResponse([
            'package'=>PackageResource::make(Package::find($request['package_id'])),
            'subscribed_days'=>$last_subscribed_days,
            'subscribe_price'=>$subscribe_price,
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->validation_rules(1),$this->validation_messages());
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
//        if (Subscribe::where(['child_id'=>$request['child_id'], 'status'=>'approved'])->first()){
//            return $this->sendError('باقتك الحالية لم تنتهى بعد');
//        }
        $standby_days=Setting::value('standby_days');
        $package=Package::find($request['package_id']);
        $package_period=$package->period;
        $subscribe_days=$request['days'];
        $subscribed=Subscribe::where('child_id',$request['child_id'])->where('status','!=','pending')->first();
        if ($subscribed){
            $subscribed_days=$this->subscribedDaysInPeriod($subscribe_days,$package_period,0);
        }else{
            $subscribed_days=$this->subscribedDaysInPeriod($subscribe_days,$package_period,$standby_days);
        }
        //dates
        $dateOfFirstDay = $subscribed_days[0];;
        //store
        $data=$request->all();
        $data['more_details']=
            [
                'first_day'=>$dateOfFirstDay,
                'subscribed_days'=>$subscribed_days,
            ];
        $subscribe=$this->model->create($data);
        $promo_code=PromoCode::find($request['promo_code_id']);
        if ($promo_code){
            $promo_code->update([
                'used'=> $promo_code->used+1
            ]);
        }
        $subscribe->update([
            'more_details'=>[
                'first_day'=>$dateOfFirstDay,
                'subscribed_days'=>$subscribed_days,
                'subscribe_price'=>$this->subscribe_price($subscribe),
                'promo_code_id'=>$request['promo_code_id']
            ]
        ]);

        return $this->sendResponse(
            [
                'package'=>PackageResource::make(Package::find($request['package_id'])),
                'first_day'=>$dateOfFirstDay,
                'subscribed_days'=>$this->subscribed_days_list($subscribe),
                'subscribe_price'=>$this->subscribe_price($subscribe),
            ]);
    }
    public function check_promo_code(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'promo_code' => 'required',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'msg' => $validate->errors()->first()],400);
        }
        if ($request->has('price')){
            if ($request['price'] < 200){
                return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode');
            }
        }
        $promo_code = PromoCode::where('code', $request['promo_code'])->first();
        $package=Package::find($request['package_id']);
        if (!$promo_code) {
            return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode');
        } elseif ($promo_code->count <= $promo_code->used) {
            return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode');
        }elseif (!$package) {
            return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode for that package');
        } elseif ($package->use_promo_code!=1) {
            return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode for that package');
        } else {
            $children_ids=Child::where('parent_id',\request()->user()->id)->pluck('id');
            $subscribes=Subscribe::whereIn('child_id',$children_ids)->get();
            foreach ($subscribes as $subscribe){
                if ($subscribe->promo_code_id == $promo_code->id){
                    return $this->sendError($request->header('lang')=='ar'?'هذا الكود غير متاح':'Invalid PromoCode for many children');
                }
            }
            return $this->sendResponse([
                'promo_code_id'=>$promo_code->id,
                'message'=>$request->header('lang')=='ar'?'هذا الكود صالح':'valid PromoCode'
            ]);
        }
    }
    public function subscribe_details($child_id){
        $subscribe=$this->current_subscribe($child_id);
        if (!$subscribe)
            return $this->sendError('ﻻ يوجد اشتراك');
        $subscribed_days_list=$this->subscribed_days_list($subscribe);
        return $this->sendResponse([
            'package'=>PackageResource::make(Package::find($subscribe->package_id)),
            'subscribed_days'=>$subscribed_days_list,
            'subscribe_price'=>$this->subscribe_price($subscribe),
        ]);
    }
    public function subscribe_promo_code($child_id){
        $subscribe=$this->current_subscribe($child_id);
        $promo_code=PromoCode::find(\request()->get('promo_code_id'));
        if (!$promo_code) {
            return $this->sendError('هذا الكود غير صالح');
        } elseif ($promo_code->count <= $promo_code->used) {
            return $this->sendError('هذا الكود غير صالح');
        } else {
            $subscribe->update([
               'promo_code_id'=>$promo_code->id,
            ]);
            $promo_code->update([
                'used'=>$promo_code->used+1
            ]);
        }
        return $this->sendResponse([
            'package'=>PackageResource::make(Package::find($subscribe->package_id)),
            'subscribed_days'=>$this->subscribed_days_list($subscribe),
            'subscribe_price'=>$this->subscribe_price($subscribe),
        ]);
    }
}
