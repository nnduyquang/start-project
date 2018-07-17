<?phpnamespace App;use Illuminate\Database\Eloquent\Model;class Post extends Model{    protected $fillable = [        'id','title','path','description','content' ,'image','isActive','post_type','user_id','seo_id','category_item_id','created_at','updated_at'    ];    public function users()    {        return $this->belongsTo('App\User', 'user_id');    }//    public function categoryitem(){//        return $this->belongsTo('App\CategoryItem','category_item_id');//    }    public function seos(){        return $this->belongsTo('App\Seo','seo_id');    }    public function categoryitems(){        return $this->belongsToMany('App\CategoryItem','category_many','item_id','category_id')->withTimestamps();    }}