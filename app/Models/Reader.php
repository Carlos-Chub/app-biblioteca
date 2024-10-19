<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Reader extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = ['uuid', 'names', 'surnames', 'date_birthday', 'phone', 'address', 'email'];

    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = hexdec(uniqid());
            if (!str_starts_with($model->phone, '+502')) {
                $model->phone = '+502' . $model->phone;
            }
        });

        self::updating(function ($model) {
            if (!str_starts_with($model->phone, '+502')) {
                $model->phone = '+502' . $model->phone;
            }
        });
    }

    public function bookReaders(): HasMany
    {
        return $this->hasMany(BookReader::class);
    }
    public function books()
    {
        return $this->hasManyThrough(Book::class, BookReader::class, 'reader_id', 'id', 'id', 'book_id');
    }
}
