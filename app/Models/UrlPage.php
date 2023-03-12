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

    /**
     * Цвет дочерней url 
     * зеленый - активировался 2 уровень и 3 уровень (полностью)
     * желтый - ативировался 2 уровень
     * 
     * @return string
     */
    public function getClassColor(): string
    {
        $classColor = '';

        if ($this->time_active != null) {
            $classColor = 'time-active-children-one-level';
        }

        $kolSyl = (int) Configuration::where('name', 'KOLSYL')->value('value');
        $count = UrlPage::where('parent_url', $this->url)
            ->where('time_active', '<>', null)
            ->count();

        if ($kolSyl == $count) {
            $classColor = 'time-active-children-two-level';
        }

        return $classColor;
    }
}