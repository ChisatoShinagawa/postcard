@extends('layouts.upload')
@section('content')
    <div class="container mt-5">
    <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header" style="background-color: e7eafb;">
                        <div class="card-title">
                            <h4 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Thank You!</h4>
                        </div>
                    </div>
                    <div class="card-body" style="background-color: e7eafb;">
                        <div>
                            <p>メッセージカードの申請が完了しました。</br>
                            配送時にお酒と一緒にこちらのカードも梱包し</br>
                            ご指定のご住所までお届けいたします。</br>
                            ご利用いただきありがとうございます。</p>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: e7eafb; border: none;">                        
                        <a href="{{ route( 'entry_orderid' ) }}" target="_self" class="btn btn-outline-secondary btn-md ml-3">Back</a>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>