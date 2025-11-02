<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // Show create form
    public function create()
    {
        $roles = config('roles.list', ['Admin','Inventory Manager','Clerk','Viewer']);
        return view('admin.users.create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed','min:8'],
            'role'     => ['required', Rule::in(config('roles.list', ['Admin','Inventory Manager','Clerk','Viewer']))],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'USER_CREATE',
            'subject_type' => User::class,
            'subject_id'   => $user->id,
            'description'  => "Created user {$user->email}",
            'meta'         => ['by' => auth()->id()],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = config('roles.list', ['Admin','Inventory Manager','Clerk','Viewer']);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'password' => ['nullable','confirmed','min:8'],
            'role'     => ['required', Rule::in(config('roles.list'))],
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];
        $user->role  = $data['role'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'USER_UPDATE',
            'subject_type' => User::class,
            'subject_id'   => $user->id,
            'description'  => "Updated user {$user->email}",
            'meta'         => ['by' => auth()->id()],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('You cannot delete your own account.');
        }

        if ($user->role === 'Admin' && User::where('role', 'Admin')->count() <= 1) {
            return back()->withErrors('You cannot delete the last Admin.');
        }

        $email = $user->email;

        $user->delete();

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'USER_DELETE',
            'subject_type' => User::class,
            'subject_id'   => $user->id,
            'description'  => "Deleted user {$email}",
            'meta'         => ['by' => auth()->id()],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "User {$email} deleted successfully.");
    }
}
