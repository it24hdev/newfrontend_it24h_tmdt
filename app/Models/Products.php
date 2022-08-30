<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'price',
        'content',
        'short_content',
        'thumb',
        'image',
        'status',
        'user_id',
        'cat_id',
        'brand',
        'unit',
        'property',
        'onsale',
        'price_onsale',
        'new',
        'specifications',
        'hot_sale',
        'event',
        'gift',
        'sold',
        'installment',
        'year',
        'still_stock',
        'time_deal',
        'youtube',
        'attr',
    ];
    const IMAGE = 'no-images.jpg';
    const ACTIVE = 1;
    const DISABLE = 0;

    public function order_item(){
        return $this->hasMany(Order_item::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class, 'product_id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }
    public function events(){
        return $this->belongsTo(Tag_event::class, 'event', 'id');
    }

    public function vote_1(){
        return $this->hasMany(Vote::class, 'product_id')->where('level', 1);
    }
    public function vote_2(){
        return $this->hasMany(Vote::class, 'product_id')->where('level', 2);
    }
    public function vote_3(){
        return $this->hasMany(Vote::class, 'product_id')->where('level', 3);
    }
    public function vote_4(){
        return $this->hasMany(Vote::class, 'product_id')->where('level', 4);
    }
    public function vote_5(){
        return $this->hasMany(Vote::class, 'product_id')->where('level', 5);
    }

    public function trungbinhsao(){
        if($this->votes->count() == 0){
            return $number = 5;
        }else{
            $count_total = $this->votes->count();
            $t = ($this->vote_1->count()*1 + $this->vote_2->count()*2 + $this->vote_3->count()*3 + $this->vote_4->count()*4 + $this->vote_5->count()*5)/($count_total);
            return $number = \round($t, 1);
        }

    }
    public function count_vote(){
        $count = 0;
        $total = 0;
        if($this->votes->count() == 0){
            $result = 0;
        }else{
            foreach($this->votes as $item){
                if(!empty($item->level)){
                    $count += $item->level;
                    $total ++;
                }
            }
            if($count == 0){
                $result = 0;
            }else{
                $result = ($count / $total) * 20;
            }
        }
        return $result;
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'category_relationships', 'product_id', 'cat_id');
    }

    public function get_specifications(){
        return \json_decode($this->specifications);
    }

}
