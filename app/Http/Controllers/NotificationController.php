<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->notifications()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreNotification  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotification $request)
    {
        return Auth::user()->notifications()->create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        
        return [
            'success' => $notification->delete(),
            'data' => $notification,
        ];
    }
}
