<?php

namespace Accellarando\TicketBear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';
    protected $fillable = ['name',
        'description',
        'status',
        'category',
        'email',
        'priority',
        'assigned_to',
        'completed'];

}
