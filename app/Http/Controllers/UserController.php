<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error fetching users', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . ($request->user_id ?? 'NULL'),
                'password' => 'required|string',
                'email' => 'required|email|max:255|unique:users,email,' . ($request->user_id ?? 'NULL'),
            ]);

            $user = User::find($request->user_id);

            if (!$user) {
                $user = new User();
            }

            $user->full_name = $data['full_name'];
            $user->username = $data['username'];
            $user->password = bcrypt($data['password']);
            $user->email = $data['email'];
            $user->facebook_username = $request['facebook_username'] ?? null;
            $user->twitter_username = $request['twitter_username'] ?? null;

            if ($request->hasFile('imageFile')) {
                $image = $request->file('imageFile');
                $imageName = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public', $imageName);
                $user->profile_image = 'storage/' . $imageName;
            }

            $user->save();

            return response()->json(['result' => 'success', 'user' => $user], 200);
        } catch (ValidationException $e) {
            return response()->json(['result' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Error creating/updating user', 'message' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['result' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Error deleting user', 'message' => $e->getMessage()], 500);
        }
    }
}
