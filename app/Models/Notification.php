<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'period',
        'pages_count',
        'idealist',
        'idealist_url',
        'olx',
        'olx_url',
        'fb',
        'fb_url',
        'telegram_settings',
    ];
}
