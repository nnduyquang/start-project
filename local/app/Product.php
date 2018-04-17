<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','name','path','description','content','code' ,'image','isActive','seo_title','seo_description','seo_keywords','price','sale','final_price','user_id','category_product_id','created_at','updated_at'
    ];
    protected $hidden = ['id'];
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function categoryproduct()
    {
        return $this->belongsTo('App\CategoryItem', 'category_product_id');
    }
}
