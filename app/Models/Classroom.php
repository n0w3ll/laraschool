<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Classroom extends Model
{
    use HasFactory;

    static public function getRecord()
    {
        $return = Classroom::select('classrooms.*', 'users.name as created_by_name')
            ->join('users','users.id','classrooms.created_by');

        if(!empty(Request::get('name')))
        {
            $return = $return->where('classrooms.name', 'like', '%' . Request::get('name') . '%' );
        }
        if(!empty(Request::get('date')))
        {
            $return = $return->whereDate('classrooms.created_at','=', Request::get('date'));
        }
        
        $return = $return->where('classrooms.is_deleted','=','0')
                        ->orderBy('classrooms.id','desc')
                        ->paginate(20);

        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
}
