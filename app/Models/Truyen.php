<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at'
        //hien thi dung chuan diffForHumans
    ];
    public $timestamps = false;
    protected $table = 'truyens';
    protected $fillable = [
        'name',
        'image',
        'category_id',
        'summary',
        'slug',
        'status',
        'created_at',
        'updated_at',
    ];

    public function categories(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
