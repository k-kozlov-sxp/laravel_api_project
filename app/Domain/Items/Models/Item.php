<?php

namespace App\Domain\Items\Models;

use App\Domain\Bookings\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'item_id');
    }
}
