<?php

namespace App\Http\Controllers;

class ImageController extends Controller {

    public function __construct(){
        //ログインセッションを確認するミドルウェアを設定
    }

    public function get( Request $reqeust, $id ){
        return Response::make( readfile( public_path() . 
        storage_path( "/img/$id" ), 200 ) )->header( 'Content-Type', 'image/png' );
        return $response;
    }
}