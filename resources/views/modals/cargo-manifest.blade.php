@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Cargo Manifest</h2>
    </div>
    @if ($cargo->count() > 0)
        <div id="cargo-items">
            @foreach ($cargo as $item)
                <button onclick="deleteCargoItem({{ $item->id }})">x</button>
                <div class="cargo-item">
                    <p contenteditable onblur="updateCargoItem({{ $item->id }})" id="item-{{ $item->id }}-name">
                        {{ $item->name }}</p>
                    <div style="flex-grow: 1;"></div>
                    <input min="0" type="number" value="{{ $item->quantity }}" id="item-{{ $item->id }}-qty"
                        onblur="updateCargoItem({{ $item->id }})" />
                </div>
                <div class="cargo-description" id="description-{{ $item->id }}">
                    <p contenteditable onblur="updateCargoItem({{ $item->id }})"
                        id="item-{{ $item->id }}-description">{{ $item->description }}</p>
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
    <button onclick="addCargoItem()" id="add-cargo">Add</button>
    <button id="close-button">Okay</button>
@endsection
