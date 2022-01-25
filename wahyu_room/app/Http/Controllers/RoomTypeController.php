<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\News;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomTypeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCreate()
    {
        return view('roomtype.create');
    }

    /**
     * Show the form for managing existing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewManage()
    {
        $datas = RoomType::all();
        return view('roomtype.manage')->with(compact('datas'));
    }

    /**
     * Show the edit form for editing armada
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUpdate($id)
    {
        $data = RoomType::findOrFail($id);
        return view('roomtype.edit')->with(compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = new RoomType();
        $data->name = $request->name;
        $data->content = $request->mcontent;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/room_types/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request,"Berhasil Menyimpan Tipe Ruangan Baru");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data = RoomType::findOrFail($id);
        $data->name = $request->name;
        $data->content = $request->mcontent;
        if ($request->hasFile('photo')) {
            $file_path = public_path() . $data->photo;
            RazkyFeb::removeFile($file_path);

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/room_types/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request,0);
    }

    /**
     * Delete Armada by filling deleted_by_id
     * @param @id of armada
     * return json or view
     */
    public function delete(Request $request, $id)
    {
        $data = RoomType::findOrFail($id);
        if ($data->delete()) {
            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }
    }

    /**
     * @param News $data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function SaveData(RoomType $data, Request $request,$message)
    {
        if ($data->save()) {
            return back()->with(["success" => "$message"]);
        } else {
            return back()->with(["errors" => "$message"]);
        }
    }
}
