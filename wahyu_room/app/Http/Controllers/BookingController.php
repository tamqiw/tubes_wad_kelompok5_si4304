<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Booking;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCreate()
    {
        return view('news.create');
    }

    /**
     * Show the form for managing existing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewManage()
    {
        $datas = Booking::all();
        return view('booking.manage')->with(compact('datas'));
    }

    /**
     */
    public function mybooking()
    {
        $datas = Booking::where('user_id', '=', Auth::id())->get();
        return view('booking.mybooking')->with(compact('datas'));
    }

    /**
     * Show the edit form for editing armada
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUpdate($id)
    {
        $data = News::findOrFail($id);
        return view('news.edit')->with(compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = new Booking();
        $data->booker_name = $request->booker_name;
        $data->booker_contact = $request->booker_contact;
        $data->checkin = $request->start_date;
        $data->checkout = $request->end_date;
        $data->notes = $request->booker_request;
        $data->user_id = Auth::id();
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/news/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data = News::findOrFail($id);
        $data->title = $request->title;
        $data->author = $request->author;
        $data->content = $request->news_content;
        $data->type = $request->type;
        if ($request->hasFile('photo')) {

            $file_path = public_path() . $data->photo;
            RazkyFeb::removeFile($file_path);

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/booking/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request);
    }

    public function delete(Request $request, $id)
    {
        $data = Booking::findOrFail($id);

        if ($data->delete()) {
            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }

    }


    public function get(Request $request)
    {

        $datas = News::all();
        if ($request->type != "") {
            $datas = News::where('type', '=', $request->type)->get();
        }
        return $datas;
    }

    public function SaveData(Booking $data, Request $request)
    {
        if ($data->save()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Menyimpan Data",
                    "Success",
                    $data,
                );

            return back()->with(["success" => "Berhasil Menyimpan Data"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Berhasil Mengupdate Data",
                    "Success",
                    ""
                );
            return back()->with(["errors" => "Gagal Menyimpan Data"]);
        }
    }
}
