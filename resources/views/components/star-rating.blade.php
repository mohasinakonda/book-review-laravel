@if ($rating)
    @for ($i = 0; $i < 5; $i++)
        {{ round($rating) > $i ? '★' : '☆' }}
    @endfor
@else
    No rating yet
@endif
