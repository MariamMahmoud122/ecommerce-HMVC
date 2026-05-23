<?php
namespace Modules\Sales\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\app\Models\OrderItem;
class Order extends Model
{
    use HasFactory;
   

    protected $fillable = ['customer_name', 'phone', 'address', 'notes', 'total_price', 'status', 'user_id'];
    public function items()
{
                                    return $this->hasMany(OrderItem::class);
}
               public function user()
    {
    
        return $this->belongsTo(\App\Models\User::class);
    }
}