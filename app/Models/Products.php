<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use function json_decode;
use function round;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    const IMAGE = 'no-images.jpg';
    const ACTIVE = 1;
    const DISABLE = 0;
    protected $table = 'products';
    protected $fillable = [
        'ma',
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
        'property_short',
        'onsale',
        'price_onsale',
        'is_new',
        'specifications',
        'is_hot',
        'event',
        'gift',
        'sold',
        'installment',
        'year',
        'still_stock',
        'time_deal',
        'youtube',
        'attr',
        'quantity',
        'detailproperty',
        'tax',
        'warranty',
        'is_promotion',
        'view',
    ];

    public function order_item()
    {
        return $this->hasMany(Order_item::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('status', 1)->orderBy('created_at', 'desc');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }

    public function events()
    {
        return $this->belongsTo(Tag_event::class, 'event', 'id');
    }

    public function vote_1()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('level', 1)->where('status', 1);
    }

    public function vote_2()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('level', 2)->where('status', 1);
    }

    public function vote_3()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('level', 3)->where('status', 1);
    }

    public function vote_4()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('level', 4)->where('status', 1);
    }

    public function vote_5()
    {
        return $this->hasMany(Vote::class, 'product_id')->where('level', 5)->where('status', 1);
    }

    public function trungbinhsao()
    {
        if ($this->votes->count() == 0) {
            return $number = 5;
        } else {
            $count_total = $this->votes->count();
            $t = ($this->vote_1->count() * 1 + $this->vote_2->count() * 2 + $this->vote_3->count() * 3 + $this->vote_4->count() * 4 + $this->vote_5->count() * 5) / ($count_total);
            return $number = round($t, 1);
        }
    }

    public function count_vote()
    {
        $count = 0;
        $total = 0;
        if ($this->votes->count() == 0) {
            $result = 0;
        } else {
            foreach ($this->votes as $item) {
                if (!empty($item->level)) {
                    $count += $item->level;
                    $total++;
                }
            }
            if ($count == 0) {
                $result = 0;
            } else {
                $result = ($count / $total) * 20;
            }
        }
        return $result;
    }

    public function pt_sl_daban()
    {
        $total = 0;
        $sold = $this->sold;
        $quantity = $this->quantity;
        $total = $sold / $quantity * 100;
        if ($total > 0) {
            $result = $total;
        } else $result = 0;
        return $result;
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_relationships', 'product_id', 'cat_id');
    }

    public function get_specifications()
    {
        return json_decode($this->specifications);
    }

}
