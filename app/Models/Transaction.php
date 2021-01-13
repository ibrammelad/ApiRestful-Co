<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory , SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'quantity' ,
         'buyer_id' ,
        'product_id'
    ];
    /**
     * @var mixed
     */


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class ,'buyer_id'  , 'id');
    }
}
