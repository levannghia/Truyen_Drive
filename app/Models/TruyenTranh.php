<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruyenTranh extends Model
{
    use HasFactory;

    protected $table = 'truyentranhs';
    protected $fillable = [
        'name',
        'image',
        'category_id',
        'summary',
        'slug',
        'tag',
        'status',
        'id_folder',
        'created_at',
        'updated_at',
    ];
    
    public function chapterTruyenTranh(){
        return $this->hasMany(chapterTruyenTranh::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
