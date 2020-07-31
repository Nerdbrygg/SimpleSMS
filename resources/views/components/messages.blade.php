<div>
    @if ($title)
        <h2>{{ $title }}</h2>
    @endif

    <ul class="list-unstyled">
        @forelse ($messages as $sms)
            <li>
                <div class="d-flex justify-content-between">
                    <span>{{ $sms->destination }}</span>
                    <span>{{ $sms->created_at->diffForHumans() }}</span>
                </div>
            </li>
        @empty
            <li><small><i>- No messages</i></small></li>
        @endforelse
    </ul>
</div>