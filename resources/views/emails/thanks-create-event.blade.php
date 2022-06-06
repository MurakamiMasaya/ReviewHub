<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <pre>{{ $user->name }}様
素敵なイベントを投稿していただきありがとうございました。</p>
今後ともReviewHubをよろしくお願いします。
<a href="{{ route('top') }}">トップページに戻る</a>

------------------------------- 
イベント概要を確認する 
------------------------------- 
電話番号 : {{ $event['contact_address'] }}
メールアドレス : {{ $event['contact_email'] }}
イベント種別 : {{ $event['segment'] === "1" ? '勉強会' : 'その他' }}
オンラインタグ :{{ $event['online'] === "1" ? 'オンライン' : '指定なし' }}
開催地 : {{ isset($event['area']) ? $event['area'] : ' 指定なし' }}
定員 : {{ $event['capacity'] }}
開始日 : {{ $event['start_date'] }}
終了日 : {{ $event['end_date'] }}
タイトル : {{ $event['title'] }}
イベント本文 : {!! nl2br(e($event['contents'])) !!}
イベントURL : {{ isset($event['url']) ? $event['url'] : '指定なし' }}
ハッシュタグ : {!! nl2br(e(isset($event['tag']) ? $event['tag'] : '指定なし')) !!}

<a href="{{ route('top') }}">トップページに戻る</a>

------------------------------- 
本メールにお心あたりが無い方へ 
------------------------------- 
このメール内容に覚えがない場合、誤って送信された可能性があります。 
その場合、大変お手数ですが、破棄していただけますようお願いいたします。 

このメールは送信専用メールアドレスから配信されています。 
このままご返信いただいてもお答えできませんのでご了承ください。 

■お問い合わせ 
ReviewHub事務局 
<a href="{{ route('contact') }}">reviewhub@gmail.com</a>

-----------------------------------------------------------------
(c) ReviewHub. All Rights Reserved.
        </pre>
    </body>
</html>


