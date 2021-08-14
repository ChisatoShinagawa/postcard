@extends('layouts.boot_upload')
@section('content')
<div class="container mt-5">
    <p class="pt-5">サービス紹介</p>
    <div class="mt-5">
        <p>概要</p>
        <p>
        商品ご購入の方に向けたメッセージカードを添付するサービスです。<br/>
        メッセージカードを登録していただくことで配送時に一緒に梱包しお届けいたします。
        </p>
    </div>
    <div class="mt-5">
        <p>詳細</p>
        <li>商品番号入力でログイン</li>
        <p>製品をご購入いただいたときに発行される商品番号を入力することによって<br/>
        メッセージカード作成画面に移行します。</p>
        <li>カードの種類を選択</li>
        <p>お好きなフレームを選びます。</p>
        <li>メッセージカード作成</li>
        <p>写真を入れたりメッセージを入力しメッセージカードを完成させます</p>
        <li>プレビュー画面</li>
        <p>戻るボタンで元の画面に戻れます。写真、メッセージの変更する場合戻ってください。</p>
        <li>登録</li>
    </div>
    <div class="my-5" style="display: inline-block;">
        <p>デモサイトへはこちらからお進みください。</p>
        <form action="{{ route( 'check_orderid' ) }}" method="post">
        @csrf
            <input type="text" name="order_id" value="3333" hidden>
            <input type="submit" class="btn btn-outline-secondary btn-md" value="Demo Site">
        </form>
    </div>
</div>
@endsection