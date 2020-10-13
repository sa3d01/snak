<?php

namespace App\Http\Controllers\Api;

use App\Child;
use App\DropDown;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChildCollection;
use App\Http\Resources\ChildResource;
use App\Http\Resources\DropDownCollection;
use App\Http\Resources\PackageCollection;
use App\Http\Resources\PackageResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Package;
use App\User;
use App\userType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class PackageController extends MasterController
{
    protected $model;

    public function __construct(Package $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    function lang(){
        if (\request()->header('lang')){
            return \request()->header('lang');
        }else{
            return 'ar';
        }
    }
    public function index(){
        return $this->sendResponse(PackageCollection::make(Package::active()->get()));
    }
    public function show($id){
        return $this->sendResponse(PackageResource::make(Package::find($id)));
    }
}
