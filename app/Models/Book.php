<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'description', 'year', 'quantity', 'category', 'cover', 'created_by', 'update_by'];
    protected $guarded = ['id'];

    protected $appends = [
        'cover_url'
    ];

    protected function getCoverUrlAttribute()
    {
        $cover = $this->cover;
        if (!str_contains($cover, 'http')){
            return asset('storage/' . $cover);
        }
        return $cover;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id')->withPivot([
            'updated_at' //jika butuh tambahan field dari tabel pivot
        ]);
    }
}
