@if(isset($white))
    @if(is_null($user->gender))
        <img src="{{ asset('images/white-icon.png') }}" alt="アイコン" />
    @elseif($user->gender == 0)
        <img src="{{ asset('images/white-man.png') }}" alt="男性アイコン" />
    @else
        <img src="{{ asset('images/white-woman.png') }}" alt="女性アイコン" />
    @endif
@else
    @if(is_null($user->gender))
        <img src="{{ asset('images/icon.png') }}" alt="アイコン" />
    @elseif($user->gender == 0)
        <img src="{{ asset('images/man.png') }}" alt="男性アイコン" />
    @else
        <img src="{{ asset('images/woman.png') }}" alt="女性アイコン" />
    @endif
@endif