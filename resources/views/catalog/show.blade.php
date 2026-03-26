@extends('layouts.app', ['title' => $product->name])

@section('content')
    <div class="card">
        <p class="muted">{{ $product->category?->name }} @if($product->brand) · {{ $product->brand->name }} @endif</p>
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->short_spec }}</p>
        @if($product->isPriceVisible() && $product->price_text)
            <p><strong>{{ $product->price_text }}</strong></p>
        @else
            <p class="muted">{{ __('catalog.price_hidden') }}</p>
        @endif

        <form method="POST" action="{{ route('quote.add', $product) }}">
            @csrf
            <label>{{ __('catalog.quantity') }}</label>
            <input class="input" type="number" min="1" name="quantity" value="1">
            <button class="btn" type="submit">{{ __('catalog.add_to_quote') }}</button>
        </form>
    </div>
@endsection
