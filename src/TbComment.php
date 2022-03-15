<?php

namespace Accellarando\TicketBear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbComment extends Model{
    public $timestamps = true;
    protected $table = "tb_comments";
    protected $fillable = ["author",
        "comment",
        "issue"];

    public function selectAndJoin($id){
        return self::select("tb_comments.*","users.name AS user")
            ->leftJoin("users","tb_comments.author","=","users.id")
            ->where("issue","=",$id)
            ->get();
    }
}
