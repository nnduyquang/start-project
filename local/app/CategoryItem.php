<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    protected $fillable = [
        'id','name','path','description','image','image_mobile','level','parent_id','type','seo_id','order','isActive','created_at','updated_at'
    ];
    protected $table = 'category_items';
    protected $hidden = ['id'];
    public function seos(){
        return $this->belongsTo('App\Seo','seo_id');
    }
}
