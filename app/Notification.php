<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use ModelBaseFunctions;
    private $route='notification';

    protected $fillable = ['receiver_id','note','read','admin_notify_type','receivers','type','more_details'];
    protected $casts = [
        'more_details' => 'json',
        'receivers' => 'array',
    ];
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id','id');
    }
    public function nameForShow($admin_notify_type){
        if ($admin_notify_type=='user'){
            return 'اشعارات العملاء' ;
        }elseif ($admin_notify_type=='provider'){
            return 'اشعارات مقدمى الخدمات' ;
        }elseif ($admin_notify_type=='all'){
            return 'اشعارات كل مستخدمى التطبيق' ;
        }else{
            return 'اشعارات موجهة' ;
        }
    }
}
