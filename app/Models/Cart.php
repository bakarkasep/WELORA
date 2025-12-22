<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    protected $guarded = [];
    // Cart punya relasi ke Produk (1 item cart adalah 1 produk)
    public function product() { return $this->belongsTo(Product::class); }
}