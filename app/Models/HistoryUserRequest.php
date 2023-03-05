<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUserRequest extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'history_user_requests';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 
        'min_price', 
        'max_price', 
        'type', 
        'user_id', 
    ];
}