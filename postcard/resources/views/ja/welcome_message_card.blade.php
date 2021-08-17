@extends('layouts.boot_upload')
@section('content')
<div class="container">
    <p>メッセージカードアプリへようこそ！</p>
    <div class="mt-5">
        <p style="text-decoration-line: underline;">アプリでできること</p>
        <p>
        写真やメッセージを添えてオリジナルメッセージカードを作れます。
        </p>
    </div>
    <div class="mt-5">
        <p style="text-decoration-line: underline;">作り方</p>
        <li>カードの種類を選択</li>
        <p>お好きなフレームを選びます。</p>
        <li>メッセージカード作成</li>
        <p>写真を入れたりメッセージを入力しカードを完成させます。</p>
        <li>プレビュー</li>
        <p>写真、メッセージの変更がある場合は戻るボタンで戻ります。</p>
        <li>PDF作成</li>
        <p></p>
        <li>PDFダウンロード</li>
    </div>
    <div class="my-5" style="display: inline-block;">
        <p>下記のボタンを押してスタート！</p>
        <form action="{{ route( 'select_card_type', 'ja' ) }}" method="post">
        @csrf
            <input type="text" name="order_id" value="3333" hidden>
            <input type="submit" class="btn btn-outline-secondary btn-md" value="スタート">
        </form>
    </div>
</div>
@endsection