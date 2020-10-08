<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use ModelBaseFunctions;

    private $route='promo_code';

    protected $fillable = ['percent','code','count','used','more_details'];
    protected $casts = [
        'more_details' => 'json',
    ];
}
