<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cateogry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function books()
    {
        return $this->hasMany(Book::class, 'cateogry_id', 'id');
    }
}
