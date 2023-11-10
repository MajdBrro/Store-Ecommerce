<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['attribute_id', 'product_id','price'];
    // protected $hidden =['translations'];//لكل الداتا الراجعة return لإخفاء الترجمات من الظهور عندما نعمل    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute(){
        return $this -> belongsTo(Attribute::class,'attribute_id');
    }

    public function translations()
    {
        return $this->hasOne(OptionTranslation::class);
    }

   
}
