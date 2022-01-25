<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Inventory;
use App\Models\Room;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function buka()
    {
        $room = Room::all();
        return view('inventory.create')->with(compact('room'));
    }

    function delete($id)
    {
        $data = Inventory::find($id);


        if ($data->delete()) {
            return view('inventory.create')->with(["success" => "Data Berhasil Dihapus"]);
        } else {
            return view('inventory.create')->with(["error" => "Data Gagal Dihapus"]);
        }
    }

    function simpan(Request $request)
    {
        $data = new Inventory();
        $data->nama_barang = $request->nama_barang;
        $data->kode_barang = $request->mcontent;
        $data->harga = $request->mcontent;
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
        return view('inventory.create')->with(compact('room'));
    }
}
