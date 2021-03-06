<div {{ $attributes }}>
    @if ($title)
        <h2>{{ $title }}</h2>
    @endif
    <form action="{{ route('sms.store') }}" method="post">
        @csrf

        @if ($source)
            <div class="form-group">
                <label for="source">{{ __('Source') }}</label>
                <input type="text" name="source" id="source" class="form-control @error('source') is-invalid @enderror" placeholder="{{ __('Source') }}">
            </div>
        @endif

        <div class="form-group">
            <label for="destination">{{ __('Destination') }}</label>
            <input type="text" name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror" placeholder="{{ __('Destination') }}" value="{{ old('destination') }}">
            @error('destination')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">{{ __('Message') }}</label>
            <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="{{ __('Message') }}">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">{{ __('Send') }}</button>

    </form>

</div>