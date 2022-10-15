<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOrArchive($viewArchive)
    {
        $viewArchive
            ? $notifications = auth()->user()->notifications
            : $notifications = auth()->user()->notifications->where('archived', false);

        return view('components.notifications-drawer', compact('notifications', 'viewArchive'));
    }
    public function indexRaw()
    {
        return auth()->user()->notifications->where('archived', false)->values()->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotificationRequest  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function read($id)
    {
        if ($id == null) return;

        $notification = Notification::find($id);
        $notification->read = !$notification->read;
        $notification->save();

        // ddd($notification);

        $archived = $notification->archived;
        $read = $notification->read;

        return compact('archived', 'read');
    }

    public function archive($id)
    {
        $notification = Notification::find($id);
        $notification->archived = !$notification->archived;
        $notification->save();

        $archived = $notification->archived;
        $read = $notification->read;

        return compact('archived', 'read');
    }
}
