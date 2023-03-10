<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlPage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'url_pages';

    /**
     * @var array
     */
    protected $fillable = [
        'url', 
        'parent_url', 
        'phone', 
        'city', 
        'age',
        'work',
        'floor',
        'payment_method',
        'time_first_open_url',
        'time_active',
        'time_payment',
    ];
}