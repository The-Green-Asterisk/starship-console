<div class="notif-drawer" id="notif-drawer">
    <input type="hidden" id="view-archive" value="{{ $viewArchive }}" />
    @if ($notifications)
        <small>
            <a href="#" id="mark-all-as-read">Mark All As Read</a>
        </small>
    @endif
    @foreach ($notifications as $notification)
        <div class="notification-div" id="notification-div-{{ $notification->id }}">
            <a href="{{ $notification->action }}" onclick="fetch('/read-notification/{{ $notification->id }}');">
                <p class="{{ $notification->read ? 'read' : 'notification' }} {{ $notification->archived ? 'archived' : '' }}" id="notification-{{ $notification->id }}">
                    {{ $notification->body }}
                </p>
            </a>
            <small><a href="#" class="read-button" id="read-button-{{ $notification->id }}">
                Mark as {{ $notification->read ? 'Unr' : 'R' }}ead
            </a></small> |
            <small><a href="#" class="archive-button" id="archive-button-{{ $notification->id }}">
                {{ $notification->archived ? 'Una' : 'A' }}rchive
            </a></small>
            <hr />
        </div>
    @endforeach
    @if ($notifications->count() <= 0)
        <p>No new notifications yet!</p>
    @endif
    @if (!$viewArchive)
        <small>
            <a href="#" id="view-archive-button">View Archive</a>
        </small>
    @endif
</div>
