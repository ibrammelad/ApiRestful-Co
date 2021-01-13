<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden =['pivot'];
    protected $dates=['deleted_at'];
    protected $fillable = [
        'name','description'
    ];


    public function Products()
    {
        return $this->belongsToMany(Product::class );
    }
}
