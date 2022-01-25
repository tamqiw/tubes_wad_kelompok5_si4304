<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Facility;
use App\Models\News;
use App\Models\RoomType;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function viewCreate()
    {
        return view('facility.create');
    }

    public function viewManage()
    {
        $datas = Facility::all();
        return view('facility.manage')->with(compact('datas'));
    }

    public function viewUpdate($id)
    {
        $data = Facility::findOrFail($id);
        return view('facility.edit')->with(compact('data'));
    }

    public function store(Request $request)
    {
        $data = new Facility();
        $data->name = $request->name;
        $data->content = $request->mcontent;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/facility/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request, "Berhasil Menyimpan Fasilitas Baru");
    }

    public function update(Request $request, $id)
    {
        $data = Facility::findOrFail($id);
        $data->name = $request->name;
        $data->content = $request->mcontent;
        if ($request->hasFile('photo')) {
            $file_path = public_path() . $data->photo;
            RazkyFeb::removeFile($file_path);

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/facility/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request, "Berhasil Mengupdate Data");
    }

    public function delete(Request $request, $id)
    {
        $data = Facility::findOrFail($id);
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
