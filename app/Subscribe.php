<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use ModelBaseFunctions;

    private $route='subscribe';

    protected $fillable = ['child_id','package_id','break_id','promo_code_id','days','month','year','status','more_details'];
    protected $casts = [
        'more_details' => 'json',
        'days' => 'array',
    ];
    public function child(){
        return $this->belongsTo(Child::class);
    }
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function break(){
        return $this->belongsTo(DropDown::class,'break_id','id');
    }
    public function pay()
    {
        $action = route('admin.subscribe.pay', ['id' => $this->attributes['id']]);
        if ($this->attributes['status'] === 'pending') {
            $name = 'تحصيل';
            $key = 'warning';
            $icon = '';
            $class = 'block';
            return "<a class='$class btn btn-$key btn-sm' data-href='$action' href='$action'><i class='os-icon os-icon-$icon-circle'></i><span>$name</span></a>";
        } else {
            $name = 'مشترك';
            $key = 'success';
            $icon = 'check';
            $class = '';
            return "<a class='$class btn btn-$key btn-sm' data-href='$action' href=''><i class='os-icon os-icon-$icon-circle'></i><span>$name</span></a>";
        }
    }


}
