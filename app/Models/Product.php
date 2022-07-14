<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const COLOR_RED = 'Red';
    public const ROLE_WHITE = 'White';
    public const COLOR_GREEN = 'Green';
    public const ROLE_BLUE = 'Blue';

    public const COLORS = [
        self::COLOR_RED,
        self::ROLE_WHITE,
        self::COLOR_GREEN,
        self::ROLE_BLUE,
    ];

    public const SIZE_SM = 'Sm';
    public const SIZE_MD = 'Md';
    public const SIZE_LG = 'Lg';
    public const SIZE_XL = 'Xl';

    public const SIZES = [
        self::SIZE_SM,
        self::SIZE_MD,
        self::SIZE_LG,
        self::SIZE_XL,
    ];

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'product_name',
        'product_code',
        'product_quantity',
        'product_details',
        'product_color',
        'product_size',
        'selling_price',
        'discount_price',
        'video_link',
        'main_slider',
        'hot_deal',
        'best_rated',
        'mid_slider',
        'hot_new',
        'trend',
        'buyone_getone',
        'image_one',
        'image_two',
        'image_three',
        'today',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
