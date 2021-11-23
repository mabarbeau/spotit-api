<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNotification;

class NotificationController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    /**
     * Returns total number of unread notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        return [
            'total' => $this->user->notifications()->unread()->count(),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->notifications()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreNotification  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotification $request)
    {
        return $this->user->notifications()->create($request->all());
    }

    /**
     * Mark the notification as read
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function read(Notification $notification)
    {   
        return [
            'success' => $notification->update(['read' => 1]),
            'data' => $notification,
        ];
    }

    /**
     * Mark the notification as unread
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function unread(Notification $notification)
    {
        return [
            'success' => $notification->update(['read' => 0]),
            'data' => $notification,
        ];
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
