<?php

namespace Accellarando\TicketBear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

/***
 * This is where the ticket queries happen.
 */
class Issue extends Model
{
    use HasFactory;

    public $timestamps = true;
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
        return self::selectAndJoin()
            ->where('assigned_to','=',$me)
            ->where('completed','=',0)
            ->get();
    }

    public function myDone($me){
        return self::selectAndJoin()
            ->where('assigned_to','=',$me)
            ->where('completed','=',1)
            ->get();
    }

    public function allDone(){
        return self::selectAndJoin()
            ->where('completed','=',1)
            ->get();
    }

    public function incoming($minPriority,$maxPriority){
        return self::selectAndJoin()
            ->whereBetween('priority',[$minPriority,$maxPriority])
            ->where('assigned_to','=',null)
            ->get();
    }

    //a tiny little helper function to do the select and join
    public function selectAndJoin(){
        return self::select("issues.*","users.name AS assigned")
            ->leftJoin("users","assigned_to","=","users.id");
    }

}
