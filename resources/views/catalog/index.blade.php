@extends('layouts.app', ['title' => __('catalog.page_title')])

@section('content')
    <div class="card">
        <form method="GET" action="{{ route('catalog.index') }}" style="display:grid;grid-template-columns:2fr 1fr auto;gap:.5rem;">
            <input class="input" type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('catalog.search_placeholder') }}">
            <select class="input" name="category">
                <option value="">{{ __('catalog.all_categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">{{ __('catalog.search_button') }}</button>
        </form>
    </div>

    <div class="grid">
        @forelse($products as $product)
            <div class="card">
                <p class="muted">{{ $product->category?->name }} @if($product->brand) · {{ $product->brand->name }} @endif</p>
                <h3>{{ $product->name }}</h3>
                <p class="muted">{{ $product->short_spec }}</p>
                @if($product->isPriceVisible() && $product->price_text)
                    <p><strong>{{ $product->price_text }}</strong></p>
                @else
                    <p class="muted">{{ __('catalog.price_hidden') }}</p>
                @endif
                <a href="{{ route('catalog.show', $product) }}">{{ __('catalog.view_detail') }}</a>
            </div>
        @empty
            <div class="card">{{ __('catalog.no_results') }}</div>
        @endforelse
    </div>

    <div>{{ $products->links() }}</div>
@endsection
