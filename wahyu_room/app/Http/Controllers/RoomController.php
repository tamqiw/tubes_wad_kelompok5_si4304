<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Facility;
use App\Models\MappingRequestSellPhoto;
use App\Models\News;
use App\Models\Room;
use App\Models\RoomPhotos;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function viewCreate()
    {
        $roomtypes = RoomType::all();
        $facilities = Facility::all();
        return view('room.create')->with(compact('roomtypes', 'facilities'));
    }

    public function viewBooking(Request $request, $id)
    {

        $data = Room::findOrFail($id);
        $facilities = Facility::all();

        return view('booking.booking')
            ->with(compact(
                'data',
                'facilities'));
    }

    public function viewManage()
    {
        $datas = Room::all();
        return view('room.manage')->with(compact('datas'));
    }

    public function viewUpdate($id)
    {
        $roomtypes = RoomType::all();
        $facilities = Facility::all();
        $data = Room::findOrFail($id);
        $photos = RoomPhotos::where('room_id', '=', $data->id)->get();

        $fac = (string)$data->facilities;
        $facilitiesarray = explode(',', $fac);

        return view('room.edit')->with(compact(
            'data',
            'roomtypes',
            'facilities',
            'facilitiesarray',
            'photos'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        $data = new Room();
        $data->name = $request->title;
        $data->desc = $request->mcontent;
        $data->price = $request->price;
        $data->capacity = $request->cap;
        $data->facilities = implode(",", $request->facilities);
        $data->type_id = $request->category;

        //ARRAY FOR SAVING IMAGE
        $dataFile = array();
        $image = $request->file('photos');

        foreach ($image as $files) {
            $destinationPath = 'web_files/rooms/';
            $file_name = $request->user . "_" . uniqid() . $files->getClientOriginalName();
            if ($files->move($destinationPath, $file_name))
                $dataFile[] = $destinationPath . $file_name;
        }


        if ($data->save()) {
            $counter = 1;
            foreach ($dataFile as $itemPhoto) {
                //Save Image into MappingRequestSellPhoto;
                $mapping = new RoomPhotos();
                $mapping->room_id = $data->id;
                $mapping->path = $itemPhoto;
                $mapping->save();
            }

            return back()->with(["success" => "Berhasil Menyimpan Ruangan"]);
        } else {
            return back()->with(["errors" => "Gagal Menambah Ruangan"]);
        }
    }

    public function storeRoomPhoto(Request $request)
    {
        $data = new RoomPhotos();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/room/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);
            $photoPath = $savePathDB;
            $data->path = $photoPath;
        }

        $data->room_id = $request->id;

        if ($data->save()) {
            RoomPhotos::where('room_id', $data->id)->delete();
            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }

    }

    public function update(Request $request, $id)
    {
        $data = Room::findOrFail($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->desc = $request->mcontent;
        $data->capacity = $request->cap;

        $data->facilities = implode(",", $request->facilities);


        $data->type_id = $request->category;

        //ARRAY FOR SAVING IMAGE
        $dataFile = array();
        $image = $request->file('photos');

        if ($image != null) {
            foreach ($image as $files) {
                $destinationPath = 'web_files/rooms/';
                $file_name = $request->user . "_" . uniqid() . $files->getClientOriginalName();
                if ($files->move($destinationPath, $file_name))
                    $dataFile[] = $destinationPath . $file_name;
            }
        }


        if ($data->save()) {
            $counter = 1;
            if ($image != null)
                foreach ($dataFile as $itemPhoto) {
                    //Save Image into MappingRequestSellPhoto;
                    $mapping = new RoomPhotos();
                    $mapping->room_id = $data->id;
                    $mapping->path = $itemPhoto;
                    $mapping->save();
                }

            return back()->with(["success" => "Berhasil Menyimpan Ruangan"]);
        } else {
            return back()->with(["errors" => "Gagal Menambah Ruangan"]);
        }

    }

    public function delete(Request $request, $id)
    {
        $data = Room::findOrFail($id);
        if ($data->delete()) {
            RoomPhotos::where('room_id', $data->id)->delete();
            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }
    }

    public function deletePhoto(Request $request, $id)
    {
        $data = RoomPhotos::findOrFail($id);
        if ($data->delete()) {
            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }
    }

    public function SaveData(Facility $data, Request $request, $message)
    {
        if ($data->save()) {
            return back()->with(["success" => "$message"]);
        } else {
            return back()->with(["errors" => "$message"]);
        }
    }
}
