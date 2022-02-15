<?php

namespace Accellarando\TicketBear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function mine($me){
        return self::where('assigned_to','=',$me)
            ->get();
    }

    public function myDone($me){
        return self::where('assigned_to','=',$me)
            ->where('completed','=',1)
            ->get();
    }

    public function allDone(){
        return self::where('completed','=',1);
    }

    public function incoming($minPriority,$maxPriority){
        return self::where('priority','>=',$minPriority)
            ->where('priority','<=',$maxPriority)
            ->get();
    }

}
