<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

     const AVAILABLE_PRODUCT = 'available';
     const UNAVAILABLE_PRODUCT = 'unavailable';
     protected $dates=['deleted_at'];
     protected $hidden =['pivot'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'quantity',
        'status',
        'seller_id'
    ];

    public function isAvailable()
    {
        return $this->status = Product::AVAILABLE_PRODUCT ;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class , 'seller_id' , 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }









}
