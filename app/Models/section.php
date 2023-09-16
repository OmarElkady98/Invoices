<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;

    protected $fillable = [ 'id' , 'section_name' , 'description' , 'created_by' ] ;

    public function product()   {
        return $this->hasMany(product::class) ;
    }
}
