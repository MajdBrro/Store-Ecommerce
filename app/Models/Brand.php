<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['photo', 'is_active'];
    // protected $hidden =['translations'];//لكل الداتا الراجعة return لإخفاء الترجمات من الظهور عندما نعمل 
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1);
    }
    public function getActive(){
        return $this -> is_active == 0 ? __('admin.un_available') : __('admin.available');
        // return  $this -> is_active  == 0 ?  ' مفعل'   : 'غير مفعل' ;

    }
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }
}
