<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <pre>{{ $user->name }}様からの通報です！！

------------------------------- 
通報内容を確認する 
------------------------------- 

ユーザー名 : {{ $user->username }}
名前 : {{ $user->name }}
メールアドレス : {{ $user->email ?? '指定なし' }}
電話番号 : {{ $user->phone ?? '指定なし' }}

タイプ : {{ $report['type'] }}
コンテンツID : {{ $report['target_id'] ?? '指定なし' }}
レビューID : {{ $report['review_id'] ?? '指定なし' }}

@if(in_array('0', $report['report']))
商業目的のコンテンツやスパム
@endif
@if(in_array('1', $report['report']))
ポルノや露骨な静的コンテンツ
@endif
@if(in_array('2', $report['report']))
児童虐待
@endif
@if(in_array('3', $report['report']))
悪意のある表現や露骨な暴力的描写
@endif
@if(in_array('4', $report['report']))
嫌がらせ、いじめ
@endif
@if(in_array('5', $report['report']))
その他
@endif

その他 : {!! nl2br(e($report['report_other'])) !!}

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




