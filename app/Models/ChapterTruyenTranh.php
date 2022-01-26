<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterTruyenTranh extends Model
{
    use HasFactory;

    protected $table = 'chapter_truyen_tranh';
    protected $fillable = [
        'title',
        'truyen_tranh_id',
        'summary',
        'image',
        'slug',
        'status',
    ];
    public function truyenTranh(){
        return $this->belongsTo(TruyenTranh::class,'truyen_tranh_id','id');
    }
}
