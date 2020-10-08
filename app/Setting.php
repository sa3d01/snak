<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ModelBaseFunctions;

    private $route='setting';
    private $images_link='media/images/setting/';

    protected $fillable = ['pages','contacts','socials','app_links','about','licence','more_details','languages'];
    protected $casts = [
        'more_details' => 'json',
        'pages' => 'array',
        'languages' => 'array',
        'contacts' => 'json',
        'socials' => 'json',
        'app_links' => 'json',
        'about' => 'json',
        'licence' => 'json',
    ];
}
