<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $appends = ['cover', 'category_name', 'all_photo'];

    function getCoverAttribute()
    {
        $data = RoomPhotos::where("room_id", "=", $this->id)->first();
        if ($data == null)
            return "";
        else
            return asset($data->path);
    }

    function getCategoryNameAttribute()
    {
        $cat = RoomType::find($this->type_id);
        if ($cat != null)
            return $cat->name;
        else
            return "";
    }

    function getAllPhotoAttribute()
    {
        return RoomPhotos::where('room_id', '=', $this->id)->get();
    }


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];
}
