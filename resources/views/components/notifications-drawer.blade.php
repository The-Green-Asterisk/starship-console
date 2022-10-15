<div class="notif-drawer" id="notif-drawer">
    @foreach ($notifications as $notification)
        <div id="notification-div-{{ $notification->id }}">
            <a href="{{ $notification->action }}" onclick="fetch('/read-notification/{{ $notification->id }}');">
                <p class="{{ $notification->read ? 'read' : 'notification' }} {{ $notification->archived ? 'archived' : '' }}" id="notification-{{ $notification->id }}">
                    {{ $notification->body }}
                </p>
            </a>
            <small><a href="#" onclick="read({{ $notification->id }})" id="read-button-{{ $notification->id }}">
                Mark as {{ $notification->read ? 'Un' : '' }}Read
            </a></small> |
            <small><a href="#" onclick="archive({{ $notification->id }}, {{ $viewArchive }})" id="archive-button-{{ $notification->id }}">
                {{ $notification->archived ? 'Un' : '' }}Archive
            </a></small>
            <hr />
        </div>
    @endforeach
    @if ($notifications->count() <= 0)
        No new notifications yet!
    @endif
    @if (!$viewArchive)
        <small>
            <a href="#" id="view-archive">View Archive</a>
        </small>
    @endif
</div>
