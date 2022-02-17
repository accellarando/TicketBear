<?php

namespace Accellarando\TicketBear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

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
            ->leftJoin('users','assigned_to','=','users.id')
            ->get();
    }

    public function myDone($me){
        return self::where('assigned_to','=',$me)
            ->where('completed','=',1)
            ->leftJoin('users','assigned_to','=','users.id')
            ->get();
    }

    public function allDone(){
        return self::where('completed','=',1)
            ->leftJoin('users','assigned_to','=','users.id')
            ->get();
    }

    public function incoming($minPriority,$maxPriority){
        //todo: implement this select & join everywhere else
        return self::select('issues.*','users.name AS assigned')
            ->whereBetween('priority',[$minPriority,$maxPriority])
            ->where('assigned_to','=',null)
            ->leftJoin('users','assigned_to','=','users.id')
            ->get();
    }

}
