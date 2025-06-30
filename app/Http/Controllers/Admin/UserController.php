<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply permission middleware to all methods in the controller
        // Adjust permissions as needed, e.g., 'view users', 'create users', 'edit users', 'delete users'
        // Using 'manage_users' as a general permission for the section for now.
    }

    public static function middleware(): array
    {
        return [
            'can:manage_users'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create', [
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name', // Ensure roles exist
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Optional: if you want a dedicated show page
        $user->load('roles');
        return Inertia::render('Admin/Users/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles'); // Load current roles for the user
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => Role::all()->pluck('name'),
            'userRoles' => $user->getRoleNames() // Pass current user roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class.',email,'.$user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]); // Remove all roles if none are provided
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Add any checks here, e.g., don't delete the currently logged-in super admin
        if ($user->id === auth()->id() && $user->hasRole('Super Admin')) {
             return redirect()->route('admin.users.index')->with('error', 'Cannot delete the currently logged in Super Admin.');
        }
        // Or prevent deletion of user with ID 1 if that's a failsafe admin
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
