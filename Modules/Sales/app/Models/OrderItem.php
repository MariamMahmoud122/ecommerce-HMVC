<?php
namespace Modules\Sales\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Catalog\app\Models\Product; 
use Modules\Sales\app\Models\Order;


class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
      
        return $this->belongsTo(Product::class);
    }
    public function order()
{
    return $this->belongsTo(Order::class);
}
}
