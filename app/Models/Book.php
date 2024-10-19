<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['uuid','title','author_id','pages','book_case','row'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function bookReaders(): HasMany
    {
        return $this->hasMany(BookReader::class);
    }
    public function readers(): HasManyThrough
    {
        return $this->hasManyThrough(Reader::class, BookReader::class, 'book_id', 'id', 'id', 'reader_id');
    }
}
