<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'chapters';
    protected $fillable = [
        'title',
        'truyen_id',
        'summary',
        'slug',
        'content',
        'status',
    ];

    public function Truyens()
    {
        return $this->belongsTo(Truyen::class,'truyen_id','id');
    }
}
