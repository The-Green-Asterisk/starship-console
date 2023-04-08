@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Cargo Manifest</h2>
    </div>
    @if ($cargo->count() > 0)
        <div id="cargo-items">
            @foreach ($cargo as $item)
                <div class="cargo-item">
                    <p>{{ $item->name }}</p>
                    <div style="flex-grow: 1;"></div>
                    <input type="number" value="{{ $item->quantity }}" id="item-{{ $item->id }}-qty" />
                </div>
                <div class="cargo-description">
                    <p>{{ $item->description }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p id="no-items">No cargo items found.</p>
    @endif
    <h3>Enter New Cargo Item</h3>
    <div class="add-cargo-section">
        <div class="name-qty">
            <input type="text" id="name" name="name" placeholder="Name">
            <input type="number" id="quantity" name="quantity" placeholder="Quantity">
        </div>
        <textarea id="description" name="description" placeholder="Description"></textarea>
    </div>
    <button id="add-cargo">Add</button>
    <button id="close-button">Okay</button>
@endsection
