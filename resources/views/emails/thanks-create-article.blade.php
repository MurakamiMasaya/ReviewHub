<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <pre>{{ $user->name }}様
素敵な記事を投稿していただきありがとうございました。</p>
今後ともReviewHubをよろしくお願いします。
<a href="{{ route('top') }}">トップページに戻る</a>

------------------------------- 
記事概要を確認する 
------------------------------- 
タイトル : {!! nl2br(e($article['title'])) !!}
記事本文 : 
{!! nl2br(e($article['contents'])) !!}
参考文献URL : 
{{ isset($article['url']) ? $article['url'] : '指定なし' }}
ハッシュタグ : 
{!! nl2br(e(isset($article['tag']) ? $article['tag'] : '指定なし')) !!}

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
<a href="{{ route('contact') }}">reviewhub.contact.us@gmail.com</a>

-----------------------------------------------------------------
(c) ReviewHub. All Rights Reserved.
        </pre>
    </body>
</html>




