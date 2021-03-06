<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <pre>{{ $user->name }}様からのお問い合わせです

------------------------------- 
お問い合わせを確認する 
------------------------------- 

ユーザー名 : {{ $user->username }}
名前 : {{ $user->name }}
メールアドレス : {{ $user->email ?? '指定なし' }}
電話番号 : {{ $user->phone ?? '指定なし' }}

タイトル : 
{!! nl2br(e($contact['title'])) !!}
お問い合わせ内容 : 
{!! nl2br(e($contact['contents'])) !!}

------------------------------- 
本メールにお心あたりが無い方へ 
------------------------------- 
このメール内容に覚えがない場合、誤って送信された可能性があります。 
その場合、大変お手数ですが、破棄していただけますようお願いいたします。 

このメールは送信専用メールアドレスから配信されています。 
このままご返信いただいてもお答えできませんのでご了承ください。 

■お問い合わせ 
ReviewHub事務局 
<a href="{{ route('contact') }}">reviewhub.contact.us@gmail.com</a>

-----------------------------------------------------------------
(c) ReviewHub. All Rights Reserved.
        </pre>
    </body>
</html>




