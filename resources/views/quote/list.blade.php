@extends('layouts.app', ['title' => __('catalog.menu_quote_list')])

@section('content')
    <div class="card">
        <h2>{{ __('catalog.menu_quote_list') }}</h2>
        @if($lineItems->isEmpty())
            <p>{{ __('catalog.empty_quote') }}</p>
        @else
            @foreach($lineItems as $line)
                <div style="display:flex;justify-content:space-between;gap:1rem;margin-bottom:.75rem;align-items:center;">
                    <div>
                        <strong>{{ $line['product']->name }}</strong>
                        <div class="muted">{{ __('catalog.quantity') }}: {{ $line['quantity'] }}</div>
                    </div>
                    <form method="POST" action="{{ route('quote.remove', $line['product']) }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" type="submit">{{ __('catalog.remove') }}</button>
                    </form>
                </div>
            @endforeach

            <hr>
            <h3>{{ __('catalog.quote_form_title') }}</h3>
            <form method="POST" action="{{ route('quote.submit') }}" style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                @csrf
                <input class="input" type="text" name="full_name" placeholder="{{ __('catalog.form_full_name') }}" required>
                <input class="input" type="text" name="company_name" placeholder="{{ __('catalog.form_company_name') }}" required>
                <input class="input" type="text" name="phone" placeholder="{{ __('catalog.form_phone') }}" required>
                <input class="input" type="email" name="email" placeholder="{{ __('catalog.form_email') }}" required>
                <input class="input" type="text" name="city" placeholder="{{ __('catalog.form_city') }}">
                <textarea class="input" name="note" placeholder="{{ __('catalog.form_note') }}"></textarea>
                <button class="btn" type="submit" style="grid-column:1/-1;">{{ __('catalog.send_quote') }}</button>
            </form>
        @endif
    </div>
@endsection
