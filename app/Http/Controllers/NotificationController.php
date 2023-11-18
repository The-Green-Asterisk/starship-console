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
            ? $notifications = auth()->user()->notifications->sortByDesc('created_at')
            : $notifications = auth()->user()->notifications->where('archived', false)->sortByDesc('created_at');

        return view('components.notifications-drawer', compact('notifications', 'viewArchive'));
    }

    public function indexRaw()
    {
        return auth()->user()->notifications->where('archived', false)->values()->toArray();
    }

    public function read(Notification $notification)
    {
        $notification->read();
        $archived = $notification->archived;
        $read = $notification->read;

        return compact('archived', 'read');
    }

    public function archive(Notification $notification)
    {
        $notification->archive();
        $archived = $notification->archived;
        $read = $notification->read;

        return compact('archived', 'read');
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
