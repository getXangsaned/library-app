<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'name',
        'role',
        'rent_date',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
