@extends('layouts.boot_upload')
@section('content')
    <div class="container mt-5">
    <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header" style="background-color: e7eafb;">
                        <div class="card-title">
                            <h4 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">メッセージカード 完成!</h4>
                        </div>
                    </div>
                    <div class="card-body" style="background-color: e7eafb;">
                        <div>
                            <p>下記のボタンからダウンロードが可能です。</br>
                            ご利用頂きありがとうございました。</br>
                            ご質問などございましたらこちらのメールアドレスまで</br>
                            お願いいたします。</br>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: e7eafb; border: none;">
                        <a href="{{ route( 'single_download_proc', $id ) }}" class="btn btn-outline-secondary btn-md ml-3">ダウンロード</a>               
                        <a href="{{ route( 'welcome_message_card', 'ja' ) }}" target="_self" class="btn btn-outline-secondary btn-sm ml-3">最初のページへ</a>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>