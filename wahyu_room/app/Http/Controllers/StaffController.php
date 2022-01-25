<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{


    public function viewAdminManage()
    {
        $users = User::all();
        return view('user.manage')->with(compact('users'));
    }

    public function viewAdminEdit($id)
    {
        $users = User::where('id', '=', $id)->first();
        return view('user.edit')->with(compact('users'));
    }

    public function viewAdminCreate()
    {
        return view('user.create');
    }


    public function viewUserEdit()
    {
        $users = Auth::user();
        return view('user.editprofileuser')->with(compact('users'));
    }


    function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            if (Auth::user()->role == 1) {
                return back()->with(["success" => "Berhasil Menghapus User $user->name"]);
            } else {
                return back()->with(["success" => "Berhasil Menghapus User $user->name"]);
            }
        } else {
            return back()->with(["error" => "Gagal Menghapus User Baru"]);
        }
    }

    function store(Request $request)
    {
        $validateComponent = [
            "user_name" => "required",
            "user_email" => "required",
            "user_password" => "required",
            "user_role" => "required",
        ];


        $this->validate($request, $validateComponent);

        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->contact = $request->user_contact;
        $user->password = bcrypt($request->user_password);
        $user->role = ($request->user_role);


        if ($user->save()) {
            if (Auth::user()->role == 1) {
                return back()->with(["success" => "Berhasil Menambahkan User Baru"]);
            }
        } else {
            return back()->with(["failed" => "Gagal Menambahkan User Baru"]);
        }
    }

    function getUserByID(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return $data;
    }

    function update(Request $request)
    {
        //        return $request;
        $validateComponent = [
            "user_name" => "required",
            "user_email" => "required",
            "user_role" => "required",
        ];

        $this->validate($request, $validateComponent);

        $user = User::find($request->id);
        if ($request->id == null)
            $user = Auth::user();

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->contact = $request->user_contact;
        $user->role = ($request->user_role);


        if ($user->update()) {
            // IF REQUEST IS FROM API
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200,
                    1,
                    200,
                    "Berhasil Mengupdate Profil",
                    "Success",
                    $user,
                );

            // IF REQUEST IS FROM WEB
            if (Auth::user()->role == 1) {
                return back()->with(["success" => "Berhasil Mengupdate Data User"]);
            }
            return back()->with(["success" => "Berhasil Mengupdate Data User"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400,
                    3,
                    400,
                    "Gagal Mengupdate Profil",
                    "Error",
                    ""
                );

            return back()->with(["failed" => "Gagal Mengupdate Data User"]);
        }
    }


    function updateProfilePhoto(Request $request)
    {
        $response = array();
        $user = Auth::user();
        $id = $user->id;


        if ($request->hasFile('photo')) {

            $file_path = public_path() . $user->photo;
            RazkyFeb::removeFile($file_path);

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $user->id . '.' . $extension;

            $savePath = "/web_files/user_profile/$id/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $user->photo = $savePathDB;

            if ($user->save()) {
                if ($request->is('api/*'))
                    return RazkyFeb::responseSuccessWithData(
                        200,
                        1,
                        200,
                        "Berhasil Mengupdate Foto Profil",
                        "Success",
                        Auth::user(),
                    );

                return redirect($request->redirectTo)->with(["success" => "Berhasil Mengupdate Profil"]);
            } else {
                if ($request->is('api/*'))
                    return RazkyFeb::responseErrorWithData(
                        400,
                        3,
                        400,
                        "Gagal Mengupdate Foto Profil",
                        "Error",
                        ""
                    );

                return redirect($request->redirectTo)->with(["errors" => "Gagal Mengupdate Profil"]);
            }
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400,
                    3,
                    400,
                    "Gagal Mengupdate Foto Profil, Silakan Lengkapi Foto",
                    "Error",
                    $request->all()
                );

            return redirect($request->redirectTo)->with(["errors" => "Gagal Mengupdate Profil"]);
        }
    }

    function updatePassword(Request $request)
    {
        // IF ID IS NOT NULL (MOST LIKELY FROM WEB)
        $user = User::find($request->id);
        if ($request->id == null) {
            $user = Auth::user(); // IF FROM API -> WITH TOKEN
        }

        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);

        $hasher = app('hash');
        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400,
                    3,
                    400,
                    "Password Lama Tidak Sesuai",
                    "Old Password Didnt Match",
                    ""
                );

            return redirect($request->redirectTo)->with(["errors" => "Password Lama Tidak Sesuai"]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();

            if ($user) {
                if ($request->is('api/*'))
                    return RazkyFeb::responseSuccessWithData(
                        200,
                        1,
                        200,
                        "Berhasil Mengupdate Password",
                        "Success",
                        Auth::user(),
                    );

                return redirect($request->redirectTo)->with(["success" => "Berhasil Mengupdate Password"]);
            } else {
                if ($request->is('api/*'))
                    return RazkyFeb::responseErrorWithData(
                        400,
                        3,
                        400,
                        "Gagal Mengupdate Password",
                        "Error",
                        ""
                    );

                return redirect($request->redirectTo)->with(["errors" => "Gagal Mengupdate Password"]);
            }
        }
    }
}
