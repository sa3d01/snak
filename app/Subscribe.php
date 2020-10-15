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


}
