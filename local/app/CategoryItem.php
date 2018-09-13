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

    public function findAllChild($dd_categorie_posts, $parent_id = 0, &$newArray)
    {
        $dash = '';
        foreach ($dd_categorie_posts as $key => $data) {
            if ($data->parent_id == $parent_id) {
                if ($data->level != 0) {
                    for ($i = 0; $i <= $data->level; $i++)
                        $dash = $dash . '---';
                    $data->name = $dash . $data->name;
                    $dash = '';
                }
                array_push($newArray, $data);
                $dd_categorie_posts->forget($key);
                self::findAllChild($dd_categorie_posts, $data->id, $newArray);
            }
        }
    }

    public function getArrayCategory($type)
    {
        $list_category = $this->where('type', CATEGORY_POST)->orderBy('order')->get();
        $newArray = [];
        self::findAllChild($list_category, 0, $newArray);
        if ($type == 'create')
//            return array_pluck($newArray, 'name', 'id');
            return $newArray;
        else {
            $list_arr = array_pluck($newArray, 'name', 'id');
            return array_map(function ($index, $value) {
                return ['index' => $index, 'value' => $value];
            }, array_keys($list_arr), $list_arr);
        }
    }
}
