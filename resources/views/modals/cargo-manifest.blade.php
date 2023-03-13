@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Cargo Manifest</h2>
    </div>
    @if ($cargo->count() > 0)
        @foreach ($cargo as $item)
            <div class="crew-members">
                <p>{{ $item->name }}</p>
                <p>{{ $item->description }}</p>
                <div style="flex-grow: 1;"></div>
                <div class="manifest-divisions">
                    <p>{{ $item->quantity }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>No cargo items found.</p>
    @endif
    <h3>Enter New Cargo Item</h3>
    <input type="text" name="name" placeholder="Name">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="quantity" placeholder="Quantity">
    <button id="add-cargo">Add</button>
    <button id="close-button">Okay</button>
@endsection
