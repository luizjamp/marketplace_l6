<?php

namespace App;

use App\Traits\Slug;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    use Slug;

    protected $fillable = ['name','description','phone','mobile_phone','slug','logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store','store_id','order_id');
    }

    public function notifyStoreOwners(array $toresId = [])
    {
        $stores = $this->whereIn('id',$toresId)->get();

        return $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
