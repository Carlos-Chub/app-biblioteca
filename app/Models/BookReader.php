<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookReader extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['reader_id', 'book_id', 'status', 'sms', 'whatsapp', 'email', 'return_date'];
    protected $dates = ['return_date'];

    public function reader(): BelongsTo
    {
        return $this->belongsTo(Reader::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public static function getUpcomingReturnsWhatsapp($startDays = 1, $endDays = 2)
    {
        $startDate = Carbon::now()->addDays($startDays)->startOfDay();
        $endDate = Carbon::now()->addDays($endDays)->endOfDay();

        return self::with(['reader', 'book'])
            ->whereHas('reader', function ($q) {
                $q->whereNull('deleted_at'); // Excluir lectores eliminados
            })
            ->whereBetween('return_date', [$startDate, $endDate])
            ->where('status', '=', 'assigned_book')
            ->where('whatsapp', '=', 1)
            ->get();
    }
    public static function getUpcomingReturnsEmail($startDays = 1, $endDays = 2)
    {
        $startDate = Carbon::now()->addDays($startDays)->startOfDay();
        $endDate = Carbon::now()->addDays($endDays)->endOfDay();

        return self::with(['reader', 'book'])
            ->whereHas('reader', function ($q) {
                $q->whereNull('deleted_at'); // Excluir lectores eliminados
            })
            ->whereBetween('return_date', [$startDate, $endDate])
            ->where('status', '=', 'assigned_book')
            ->where('email', '=', 1)
            ->get();
    }
    public function getReturnDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
