<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string',
                'email' => 'required|email|max:255|unique:users',
            ]);

            if ($request->hasFile('imageFile')) {
                $image = $request->file('imageFile');
                $imageName = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public', $imageName);
            } else {
                $imagePath = null;
            }

            $user = User::create([
                'full_name' => $data['full_name'],
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'profile_image' => $imagePath,
                'facebook_username' => $request['facebook_username'] ?? null,
                'twitter_username' => $request['twitter_username'] ?? null,
            ]);

            return response()->json(['result' => 'success', 'user' => $user], 200);
        } catch (ValidationException $e) {
            return response()->json(['result' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Error creating user', 'message' => $e->getMessage()], 500);
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
    public function destroy(string $id)
    {
        //
    }
}
