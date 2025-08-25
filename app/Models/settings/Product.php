<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_settings';

    protected $fillable = [

        'stock_notifications',
        'track_inventory',
        'convert_products',

        'auto_update_products',

        'auto_fill_products',

        'default_quantity',

        'show_products_quantity',

          'show_products_cost',

        'show_products',

        'notification_threshold'



    ];
}
