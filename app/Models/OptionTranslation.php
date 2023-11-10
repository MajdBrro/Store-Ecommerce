<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;
    public function translations()
    {
        return $this->belongsTo(Option::class,'option_id');
    }
}
