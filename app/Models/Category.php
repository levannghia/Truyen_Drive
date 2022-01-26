<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'description',
        'slug',
        'status',
    ];
    public function truyens()
    {
        return $this->hasMany(Truyen::class);
    }
    public function truyenTranh()
    {
        return $this->hasMany(TruyenTranh::class);
    }
}
