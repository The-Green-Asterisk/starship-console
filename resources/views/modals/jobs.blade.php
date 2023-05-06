@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Jobs</h2>
    </div>
    @if ($jobs->count() > 0)
        <div id="jobs">
            @foreach ($jobs as $job)
                <div class="job" id="job-{{ $job->id }}">
                    <p contenteditable onkeydown="limit255(this)" onblur="updatejob({{ $job->id }})"
                        id="job-{{ $job->id }}-name">
                        {{ $job->name }}</p>
                    <div style="flex-grow: 1;"></div>
                    <select id="job-{{ $job->id }}-client" onchange="updatejob({{ $job->id }})">
                        <option value="0">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $job->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}</option>
                        @endforeach
                    </select>
                    <button onclick="deleteCargojob({{ $job->id }})" style="margin: 0" title="Delete">x</button>
                </div>
                <div class="cargo-description" id="description-{{ $job->id }}">
                    <p contenteditable onkeydown="limitLong(this)" onblur="updateCargojob({{ $job->id }})"
                        id="job-{{ $job->id }}-description">{{ $job->description }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p id="no-jobs">No jobs found.</p>
    @endif
    <h3>Enter New job</h3>
    <div class="add-job-section">
        <div class="name-qty">
            <input type="text" id="name" name="name" placeholder="Name" maxlength="255">
            <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="0" max="2147483647">
        </div>
        <textarea id="description" name="description" placeholder="Description" maxlength="65535"></textarea>
    </div>
    <button onclick="addCargojob()" id="add-cargo">Add</button>
    <button id="close-button">Okay</button>
@endsection
