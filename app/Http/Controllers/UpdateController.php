<?php

namespace App\Http\Controllers;

use App\Update;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Update::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function show(Update $update)
    {
        return $update;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Update $update)
    {
        $class = $update['class'];
        if (class_exists($class)) {
            $class::update($update['data']);
            $update->delete();
        }
        return [
            'status' => 'success',
            'message' => str_replace('App\\', '', $class) . ' updated'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function reject(Update $update)
    {
        $update['status'] = 'rejected';
        $class = str_replace('App\\', '', $update['class']);
        $update->update();
        return [
            'status' => 'success',
            'message' => "Update for $class rejected"
        ];
    }
}
