<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    public function pengguna()
    {
        return Inertia::render('Admin/Pengguna', [
            // 'users' => User::limit(10)->get(),
            // 'users' => User::all(),
            'user' => auth()->user()
        ]);
    }

    public function penggunaDatatable()
    {

        $email = isset($_GET['email']) ? $_GET['email'] : '';

        $query = User::query();


        if ($email !== '') {
            $query->where('email', $email);
        }

        return DataTables::eloquent($query)
            ->addColumn('actions', function ($user) {
                return '<button data-id="' . $user->id . '"  type="button" class="btn-delete-user btn btn-danger"><i
                        class="fas fa-trash"></i></button>
                        <button data-id="' . $user->id . '" data-name="' . $user->name . '" data-email="' . $user->email . '" data-whatsapp="' . $user->whatsapp . '" data-alamat="' . $user->alamat . '" data-role="' . $user->role . '"  type="button" class="btn-update-user btn btn-warning ml-2"
                        data-toggle="modal" data-target="#modalUser"><i class="fas fa-pen"></i></button>
            ';
                // Add other action buttons as needed
            })
            ->addColumn('password', function ($user) {
                return '
                <button data-id="' . $user->id . '" type="button" class="btn btn-info btn-reset"><i
                        class="fas fa-sync"></i> Reset pass</button>
            ';
            })
            ->rawColumns(['actions', 'password'])
            ->toJson();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'whatsapp' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'role' => $request->role,
            'whatsapp' => $request->whatsapp,
            'alamat' => $request->alamat,
        ]);

        event(new Registered($user));

        return redirect()->back()->with('message', 'Data successfully stored!');
    }

    public function update(Request $request)
    {

        // Find the user record by ID
        $user = User::find($request->id);

        // Check if user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->whatsapp = $request->whatsapp;
        $user->role = $request->role;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->email);
        $user->save();

        return redirect()->back()->with('success', 'User has been updated');
    }


    public function delete($id)
    {
        // Perform deletion logic here, e.g., delete row from database
        User::find($id)->delete();

        // Return a response indicating successful deletion
        // return redirect()->back()->with('message', 'Data successfully deleted!');
        return response()->json(['message' => 'Data successfully deleted!']);
    }

    public function resetPass($id)
    {

        $user = User::find($id);
        $user->password = bcrypt('123456');
        $user->save();
        return redirect()->back()->with('message', 'Data successfully reset!');
    }
}
