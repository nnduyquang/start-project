<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','name','path','description','content','code' ,'image','sub_image','is_active','is_hot','price','sale','final_price','user_id','category_product_id','seo_id','created_at','updated_at'
    ];
    protected $hidden = ['id'];
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function categoryitems($type)
    {
        return $this->belongsToMany('App\CategoryItem', 'category_many', 'item_id', 'category_id')->withPivot('type')->wherePivot('type', $type)->withTimestamps();
    }
    public function seos(){
        return $this->belongsTo('App\Seo','seo_id');
    }
    public function locations()
    {
        return $this->belongsToMany('App\Location', 'location_album', 'product_id', 'location_id')->withTimestamps();
    }
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_product', 'product_id', 'post_id')->withTimestamps();
    }
    public function getAllProductActiveOrderById(){
        return $this->where('is_active',ACTIVE)->orderBy('id','DESC')->get();
    }
    public function setIsActiveAttribute($value)
    {
        if (!IsNullOrEmptyString($value)) {
            $this->attributes['is_active'] = 1;
        } else {
            $this->attributes['is_active'] = 0;
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = substr($value, strpos($value, 'images'), strlen($value) - 1);
        } else
            $this->attributes['image'] = null;
    }

    public function setPathAttribute($value)
    {
        if (IsNullOrEmptyString($value))
            $this->attributes['path'] = chuyen_chuoi_thanh_path($this->name);
    }

    public function setOrderAttribute($value)
    {
        if (IsNullOrEmptyString($value))
            $this->attributes['order'] = 1;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
}
