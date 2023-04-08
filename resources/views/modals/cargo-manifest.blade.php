@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Cargo Manifest</h2>
    </div>
    @if ($cargo->count() > 0)
        <div id="cargo-items">
            @foreach ($cargo as $item)
                <div class="cargo-item" id="item-{{ $item->id }}">
                    <p contenteditable onkeydown="limit255(this)" onblur="updateCargoItem({{ $item->id }})"
                        id="item-{{ $item->id }}-name">
                        {{ $item->name }}</p>
                    <div style="flex-grow: 1;"></div>
                    <input min="0" max="2147483647" type="number" value="{{ $item->quantity }}"
                        id="item-{{ $item->id }}-qty" onblur="updateCargoItem({{ $item->id }})" />
                    <button onclick="deleteCargoItem({{ $item->id }})" style="margin: 0" title="Delete">x</button>
                </div>
                <div class="cargo-description" id="description-{{ $item->id }}">
                    <p contenteditable onkeydown="limitLong(this)" onblur="updateCargoItem({{ $item->id }})"
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
            <input type="text" id="name" name="name" placeholder="Name" maxlength="255">
            <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="0" max="2147483647">
        </div>
        <textarea id="description" name="description" placeholder="Description" maxlength="65535"></textarea>
    </div>
    <button onclick="addCargoItem()" id="add-cargo">Add</button>
    <button id="close-button">Okay</button>
@endsection
