
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // عرض المستخدمين
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users', compact('users'));
    }

    // إضافة مستخدم
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users');
    }

    // تعديل المستخدم
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $users = DB::table('users')->get();

        return view('users', compact('user', 'users'));
    }

    // تحديث المستخدم باستخدام Eloquent
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8',
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/users');
    }

    // حذف المستخدم باستخدام Eloquent
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users');
    }
}
