<div class="notif-drawer" id="notif-drawer">
    @foreach ($notifications as $notification)
        <div id="notification-div-{{ $notification->id }}">
            <a href="{{ $notification->action }}" onclick="fetch('/read-notification/{{ $notification->id }}');">
                <p class="{{ $notification->read ? 'notification not-bold' : 'notification bold' }}" id="notification-{{ $notification->id }}">
                    {{ $notification->body }}
                </p>
            </a>
            <small><a href="#" onclick="read({{ $notification->id }})">Mark as Read</a></small> |
            <small><a href="#" onclick="archive({{ $notification->id }})">Archive</a></small>
            <hr />
        </div>
    @endforeach
    @if ($notifications->count() <= 0)
        No notifications yet!
    @endif
</div>
