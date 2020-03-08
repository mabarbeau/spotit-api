<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return User::select('id', 'name', 'picture')->paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Get the currently authenticated user
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }
        return [
            'status' => 'success',
            'user' => $user
        ];
    }
}
