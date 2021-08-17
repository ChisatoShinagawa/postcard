<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Datetime;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Form;
use setasign\Fpdi\Fpdi;
use App\Order;
use App\Message_card;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\URL;
use FPDF;
use PDF;
use PDF_ja;
use Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

require( base_path( '/app/fpdf/japanese.php' ) );
require( base_path( '/vendor/autoload.php' ) );

class PDFController extends Controller
{
    public function welcome_message_card( Request $request, $lang )
    {
        $view = view( 'en.welcome_message_card' );//var_dump( App::getLocale());exit;
        // if( App::getLocale() ){
        //     $lang = App::getLocale();
            switch( $lang ){
                case 'ja':
                    $view = view( 'ja.welcome_message_card' );
                    break;
                case 'en':
                    $view = view( 'en.welcome_message_card' );
                    break;
                default:
                    $view = view( 'en.welcome_message_card' );
                    break;
            }
        // }
        $view->with( 'current_route_name', Route::currentRouteName() );
        return $view;
    }

    // public function en( Request $request )
    // {
    //     $request->session()->put( 'lang', 'en' );
    //     $view = view( 'en.welcome_message_card' );
    //     return $view;
    // }

    public function entry_orderid()
    {
        return view( 'entry_orderid' );
    }

    public function check_orderid( Request $request )
    {
        $pro_id = '';
        $key_day = 0;

        $validator = $this->message_card_rules( $request->input() );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }

        // redirect if delivery date is within key days
        $key = $request->input( 'order_id' );
        $order = Order::find( $key );
        $delivery_day = $order->delivery_at;
        $timestamp_delivery_day = strtotime( date( 'Y-m-d', strtotime( $delivery_day ) ) ); //時間を消して日付だけにしてそれをタイムスタンプに
        
        // get timestamp both due date and delivery date
        $key_day = Config::get( 'app.key_day' );
        $timestamp_due_day = $timestamp_delivery_day - ( $key_day * 24 * 60 * 60 ); // key days 24 hours 60 min 60secs
        // compare today's and delivery day's timestamps
        $today = strtotime( date( "Y-m-d", time() ) );
        if( $today > $timestamp_due_day ){
            $error = '出荷日'.$key_day.'日前までの受付となります。';
            return redirect()->route( 'entry_orderid' )->withErrors( ['order_id' => $error] );
        }

        $request->session()->put( 'order_id', $request->input( 'order_id' ) );
        // set provisional id
        $pro_id = $request->input( 'order_id' ).'_'.time();
        $request->session()->put( 'pro_id', $pro_id );
        return redirect()->route( 'select_card_type' );
    }

    public function message_card_rules( array $data )
    {
        $key_day = 0;
        $limit = 0;
        $messages = [];

        $key_day = Config::get( 'app.key_day' );
        $limit = time() + $key_day * 24 * 3600;

        $messages = [
            'order_id.exists' => '注文番号をお確かめください。', // orders,id まで書くと出ない
            'delivery_at'     => "出荷日から{$key_day}日前までの受付となります。"
        ];
        $validator = Validator::make( $data, [
            'order_id'    => ['exists:orders,id'],
            'delivery_at' => "before:{$limit}",
        ], $messages );
        return $validator;        
    }

    public function selectCardType( Request $request, $lang )
    {
        if( !session()->has( 'pro_id' ) | !session()->has( 'order_id' ) ){
            // set provisional id for indivisual user ( didn't go through check_orderid )
            $pro_id = time().time();
            $order_id = 3333;
            $request->session()->put( 'pro_id', $pro_id );
            $request->session()->put( 'order_id', $order_id );
        }

        switch( $lang ){
            case 'ja':
                $view = view( 'ja.select_card_type' );
                break;
            case 'en':
                $view = view( 'en.select_card_type' );
                break;
            default:
            $view = view( 'en.select_card_type' );
            break;
        }
        $view->with( 'current_route_name', Route::currentRouteName() );
        return $view;
    }

    public function upload( Request $request, $lang )
    {
        $cardType = '';
        $templateImage = '';
        $data = [];
        $original_image = null;
        $form = [];
//var_dump(App::getLocale());exit;
        // save card type if it's first visit
        if( !empty( $request->input( 'cardType' ) ) ){
            $request->session()->put( 'cardType', $request->input( 'cardType' ) );
        };

        $cardType = $request->session()->get( 'cardType' );
        // card type : flower
        if( $cardType === 'flower' ){
            $templateImage = Storage::url( 'img/exa_ja1.png' );
            // en
            if( $lang === 'en' ){
                $templateImage = Storage::url( 'img/exa_eng1.png' );
            }
        }
        // card type : leaf
        if( $cardType === 'leaf' ){
            $templateImage = Storage::url( 'img/pre_5.png' );
        }

        // get card info from session when it's the second visit or failed validation
        if( $request->session()->has( 'card_info.input' ) ){
            $data = $request->session()->get( 'card_info.input' );
            if( $request->session()->has( 'card_info.input.image' ) ){
            $original_image = Storage::url( 'img/uploads/'.$data['image'] );
            }
        }

        $form = $this->getUploadForm( $data );

        switch( $lang ){
            case 'ja':
                $view = view( 'ja.upload' );
                break;
            case 'en':
                $view = view( 'en.upload' );
                break;
            default:
            $view = view( 'en.upload' );
            break;
        }
        $view->with( 'templateImage', $templateImage );
        $view->with( 'form', $form );
        $view->with( 'original_image', $original_image );
        $view->with( 'current_route_name', Route::currentRouteName() );
        return $view;
    }

    public function getUploadForm( $value = [] )
    {
        return[
            'message_to'     => Form::text( 'message_to', $value['message_to'] ?? NULL, ["id"=>"message","class"=>"form-control"] ),
            'message_content'=> Form::text( 'message_content', $value['message_content'] ?? NULL, ["id"=>"message","class"=>"form-control"] ),
            'message_from'   => Form::text( 'message_from', $value['message_from'] ?? NULL, ["id"=>"message","class"=>"form-control"] ),
        ];
    }

    public function uploadProc( Request $request )
    {
        $file = '';
        $key = '';
        $name = '';
        $target_path = '';
        
        // save entered card info before vaidation
        $request->session()->put( 'card_info.input.message_to', $request->message_to ?? NULL );
        $request->session()->put( 'card_info.input.message_content', $request->message_content ?? NULL );
        $request->session()->put( 'card_info.input.message_from', $request->message_from ?? NULL );

        // message_card_ruleと合わせるべきか？質問②
        $rule = [
            'message_to'     => 'max:11',
            'message_content'=> 'max:56',
            'message_from'   => 'max:11',
        ];
        //$rule = __("{$lang}.rule.pdf_upload");//こちらにする

        if( $request->session()->has( 'card_info.input.image' ) ) {
            // image nullable if it's second visit     
            $rule['image'] = 'nullable|mimes:jpeg,jpg,png|image|max:4000'; // File size 3mbはアウト
        } else {
            // image required if it's first visit
            $rule['image'] = 'required|mimes:jpeg,jpg,png|image|max:4000';
        }

        // en
        if( $request->session()->get( 'lang' ) === 'en' ){
            $rule = [
                'message_to'     => 'max:22',
                'message_content'=> 'max:112',
                'message_from'   => 'max:22',
            ];
            if( $request->session()->has( 'card_info.input.image' ) ) {
                // image nullable if it's second visit     
                $rule['image'] = 'nullable|mimes:jpeg,jpg,png|image|max:4000';
            } else {
                // image required if it's first visit
                $rule['image'] = 'required|mimes:jpeg,jpg,png|image|max:4000';
            }
        }
        
        $validator = $request->validate( $rule );

        if( $request->file( 'image' ) ){
            // delete previous image and save new one, when it's second time　やり直し必須！
            if( $request->session()->get( 'card_info.input.image' ) ){
                Storage::delete( 'public/img/uploads/'.$request->session()->get( 'card_info.input.image' ) );
                Storage::delete( 'public/img/previews/'.$request->session()->get( 'card_info.input.image' ) );
            }
            // save image in storage with provisional id as file name
            $file = $request->file( 'image' );
            $key = $request->session()->get( 'pro_id' );
            $name = $key.'.'.$file->getClientOriginalExtension();
            $target_path = storage_path( '/app/public/img/uploads/' );
            $file->move( $target_path, $name ); 

            $request->session()->put( 'card_info.input.image', $name ); // いる？

            // resize and make image with template then save
            // open inserted image
            $insert_img = ImageManagerStatic::make( storage_path( 'app/public/img/uploads/'.$name ) );

            // open a template file
            $img = ImageManagerStatic::make( storage_path( 'app/public/img/photocard6.png' ) );

            // crop and resize ( flower2 )
            $insert_img = $insert_img->resize( 316, null, function( $constraint ){
                $constraint->aspectRatio();
            } );
            $img->insert( $insert_img, 'top-left', 40, 19 );
            // $insert_img = $insert_img->orientate() // orientate()を入れれば回転は避けられる
            //                             ->resize( 316, null, function( $constraint ){ // 試し
            //                                 $constraint->aspectRatio(); // 試し
            //                                 } ); // 試し
            // $img->insert( $insert_img, 'top-left', 40, 19 ); // 試し
                
            // save preview image in storage without message
            $pre_name = storage_path( 'app/public/img/previews/'.$name ); 
    
            $img->save( $pre_name );
        }

        // set dammy id for preview ( won't be used )
        $id = $request->session()->get( 'pro_id' );

        $lang = App::getLocale();
        //return redirect()->route( 'preview', $id );
        return redirect()->route( 'preview', ['lang' => $lang, 'id' => $id] );
        //return redirect( 'home/siberianhusky/projects/postcard/resources/views/'.$lnag.'/preview' );
    }

    public function preview( Request $request, $lang, $id )
    {
        // card type
        $cardType = $request->session()->get( 'cardType' );
        // if( $cardType === 'flower' ){
        // }
        
        // customer : get a main image and message detail from session
        if( !empty( $request->session()->get( 'card_info.input' ) ) ){
            $image = $request->session()->get( 'card_info.input.image' );
            $message_to = $request->session()->get( 'card_info.input.message_to' );
            $message_content = $request->session()->get( 'card_info.input.message_content' );
            $message_from = $request->session()->get( 'card_info.input.message_from' );
            $view = view( 'en.preview_flower2' );  
//var_dump(App::getLocale());exit;
            if( App::getLocale() ){
                $lang = App::getLocale();
                switch( $lang ){
                    case 'ja':
                        $view = view( 'ja.preview_flower2' );
                        break;
                    case 'en':
                        $view = view( 'en.preview_flower2' );
                        break;
                    default:
                    $view = view( 'en.preview_flower2' );
                    break;
                }
            }                    
        } else{
            // admin : get a main image and message detail from Database
            $message_card = Message_card::find( $id );
            $image           = $message_card->image;
            $message_to      = $message_card->message_to;
            $message_content = $message_card->message_content;
            $message_from    = $message_card->message_from;
            $view = view( 'ja.preview_flower2' );
        }

        $url_img = Storage::url( 'img/previews/'.$image );
       
        $num = mb_strlen( $message_content );
    
        // 4 rows
        if( 73 > $num && $num > 54 ){
            $message_content_4 = $message_content;
        }
        // 3 rows
        if( 55 > $num && $num > 36 ){
            $message_content_3 = $message_content;
        }
        // 2 rows
        if( 37 > $num && $num > 18 ){
            $message_content_2 = $message_content;
        }
        // 1 rows
        if( 19 > $num && $num > 0 ){
            $message_content_1 = $message_content;
        }

        // en
        if( $lang === 'en' ){
            // 4 rows
            if( 145 > $num && $num > 108 ){
                $message_content_4 = $message_content;
            }
            // 3 rows
            if( 109 > $num && $num > 72 ){
                $message_content_3 = $message_content;
            }
            // 2 rows
            if( 73 > $num && $num > 36 ){
                $message_content_2 = $message_content;
            }
            // 1 rows
            if( 37 > $num && $num > 0 ){
                $message_content_1 = $message_content;
            }
        }
        
        if( !empty( $message_content_4 ) ){
            $view->with( 'message_content_4', $message_content_4 );
        }
        if( !empty( $message_content_3 ) ){
            $view->with( 'message_content_3', $message_content_3 );
        }
        if( !empty( $message_content_2 ) ){
            $view->with( 'message_content_2', $message_content_2 );
        }
        if( !empty( $message_content_1 ) ){
            $view->with( 'message_content_1', $message_content_1 );
        }

        $view->with( 'message_to', $message_to ); 
        $view->with( 'message_from', $message_from );
        $view->with( 'url_img', $url_img );
        $view->with( 'current_route_name', Route::currentRouteName() );
        return $view;
    }

    public function registerProc( Request $request )
    {
        //$message_card_info = Message_card::find( $id );
        //$message_card_info = Message_card::where( 'order_id', $request->session->get( 'order_id' ) );
        //var_dump( $message_card_info);exit;

        // put all information into the Database
        //$message_card_info = new Message_card;
        $data = [];
        $message_card = '';
//var_dump($request->session()->get( 'order_id' ));exit;
        $data = $request->session()->get( 'card_info.input' );
        if( !$data ){
            return redirect()->route( 'entry_orderid' );
        }
        $message_card = Message_card::create( [
                    'order_id'       => $request->session()->get( 'order_id' ),
                    'image'          => $data['image'],
                    'message_to'     => $data['message_to'],
                    'message_content'=> $data['message_content'],
                    'message_from'   => $data['message_from'],
                ] );            
        $request->session()->forget( 'card_info.input' );
        // get ID on which just created in messege_card
        $id = $message_card->id;
        
        // PDF作成へ
        return redirect()->route( 'create_pdf', $id );        
    }

    protected function getDpi( $filename )
    {
        $img = '';
        $extension = pathinfo( $filename, PATHINFO_EXTENSION );
        if( $extension === 'jpg' || $extension === 'jpeg'){
            $img = imagecreatefromjpeg( $filename );
        } elseif( $extension === 'png' ){
            $img = imagecreatefrompng( $filename );
        }        
        return imageresolution( $img );var_dump($img);exit;
    }

    protected function resizeImageForPdf( $filename, $width, $height )
    {
        $img = '';
        $destinationPath = '';

        $destinationPath = storage_path( '/app/public/img/resize/' );
        // open a file
        $img = ImageManagerStatic::make( storage_path( 'app/public/img/uploads/'.$filename ) );
        //$img->resize( 567, 340, function( $constraint ){ //small 640 480
        $img->resize( $width, null, function( $constraint ){ // 1129 * 752 pixel for making 95.6 * 63.7 mm
            $constraint->aspectRatio();
        } )->save( $destinationPath.$filename );
    }

    public function createPdf( Request $request, $id )
    {
        $data = [];
        $img_name        = '';
        $img_path        = '';
        $message_to      = '';
        $message_content = '';
        $message_from    = '';
        $order_id        = '';
        $cardType        = '';

        $message_card = Message_card::find( $id );

                // get current data information from session
                //$data = $request->session()->get( 'card_info.input' );        
        $img_name        = $message_card->image;
        $img_path        = storage_path( 'app/public/img/uploads/'.$img_name );
        $message_to      = $message_card->message_to;
        $message_content = $message_card->message_content;
        $message_from    = $message_card->message_from;
        //$order_id        = $request->session()->get( 'order_id' );
        $cardType        = $request->session()->get( 'cardType' );

        $paper_W_mm = 111; // 4 * 6 inch array( 101.6, 152.4 )
        $paper_H_mm = 156;
        // card type
        if( $cardType === 'flower' ){
            $pdf = new Fpdi( 'P', 'mm', array( $paper_W_mm, $paper_H_mm ) ); 
            $pdf->AddSJISFont();
            $pdf->AddPage();

            // set template pdf
            $path = storage_path( 'app/public/photocard6.pdf' );
            $pdf->setSourceFile( $path );
            $tplId = $pdf->importPage( 1 );
            $pdf->useTemplate( $tplId, null, null, null, null, true );       

            /*set image*/
            // get width of image(pixel)
            $image = getimagesize( $img_path ); // 4032 * 3024 pixel だいたい250mb 展開するメモリが必要
            $origin_w = $image[0]; // 4032
            $origin_h = $image[1]; // 3024
            
            // get dpi
            $dpi = $this->getDpi( $img_path );
            $dpi_x = $dpi[0]; // 96  // 25.4mm(1 inch)に96個のドット
            $dpi_y = $dpi[1];

            // original image size (mm)
            $origin_w_mm = $origin_w / $dpi_x * 25.4; // 1066.8
            $origin_h_mm = $origin_h / $dpi_y * 25.4; // 800.1
            
            // model image size printed
                // fix Width version
                // $final_W_mm = 96.3; //95.6mm / 25.4 → inc * 96 dpi → 361 dot(pixel)
                // $final_W_inch = $final_W_mm / 25.4 * 96; // PDFのデフォルトDPI：96(必要な画素数)
                // $key = $final_W_inch / $origin_w; // 元の $key : 0.0896 倍すると理想の大きさになる
                // $final_H_mm = $origin_h_mm * $key; // 71.7
                // $final_H_inch = $origin_h * $key;

            // fix Height version
            $final_H_mm = 60; // 60mm / 25.4 → inc * 96 dpi → 241.8 dot(pixel)
            $final_H_inch = $final_H_mm / 25.4 * 96; // PDFのデフォルトDPI：96(必要な画素数)
       
            $key = $final_H_inch / $origin_h; // 元の $key : 0.0896 倍すると理想の大きさになる
            $final_W_mm = $origin_w_mm * $key; // 71.7
            $final_W_inch = $origin_w * $key;
            //var_dump($final_H_mm);exit; 

            //$w = $origin_w * $key;
            // final size in pixel
            // $W_pixel = $final_W_mm * $dpi_x; // 9177.6
            // $H_pixel = $final_H_mm * $dpi_y; // 6883.2         
            
            //resize
            $this->resizeImageForPdf( $img_name, $final_W_inch * 2, $final_H_inch * 2 );

            $img = storage_path( 'app/public/img/resize/'.$img_name );            
            
            /*get start point*/
            $image_frame_y = 68.5 + 2.5; // frame 68.5 mm + window padding 4 
            $x = ( $paper_W_mm / 2 - 5 ) - $final_W_mm / 2;  
            $y = $image_frame_y / 2 - $final_H_mm / 2; // flowerでは39.65mm がimage枠の高さの中心
            $pdf->Image( $img, $x, $y, '', 60 );

            /*add text with ja version*/ 
            $pdf->SetFont('sjis', '', '18');
            $pdf->SetTextColor( 46, 23, 99 );
            // ward wrap
            // dear
            $pdf->SetXY( 9.5, 76.2 ); // center 76.2
            $pdf->SetFontSize( 12 );
            $message_to = mb_convert_encoding( $message_to, 'SJIS', 'UTF-8' );
            $pdf->MultiCell( 0, 8, 'Dear  '.$message_to, 0, 'C', false ); // 4番目を0でno frame, 1でwith frame

            // text message
            $pdf->SetXY( 9.9, 90 );
            $pdf->SetFontSize( 12 );        
            $message_content = mb_convert_encoding( $message_content, 'SJIS', 'UTF-8' );
            $pdf->MultiCell( 0, 8, $message_content, 0, 'L', false );

            // from
            $pdf->SetXY( 9.5, 120 );
            $pdf->SetFontSize( 12 );
            $message_from = mb_convert_encoding( $message_from, 'SJIS', 'UTF-8' );
            $pdf->MultiCell( 0, 8, 'From  '.$message_from, 0, 'C', false );

            $name = $id.'.pdf';

        } elseif( $cardType === "leaf" ){
           
        }

        $pdf->Output( 'I', $name ); // when want to see on the screen directly        
        //$pdf->Output('F', storage_path( 'app/public/pdf/'.$name ) );

        // save it in the database
        $message_card->pdf = $name;
        $message_card->save();

        // remove all data from session
        $request->session()->flush();
        
        return redirect()->route( 'download_pdf', $id );
    }

    public function downloadPdf( $lang, $id )
    {
        $view = view( 'ja.download_pdf' );
        switch( $lang ){
            case 'ja':
                $view = view( 'ja.download_pdf' );
                break;
            case 'en':
                $view = view( 'en.download_pdf' );
                break;
            default:
            $view = view( 'en.download_pdf' );
            break;
        }
        $view->with( 'id', $id );
        $view->with( 'current_route_name', Route::currentRouteName() );
        return $view;
    }

    public function complete()
    {
        return view( 'completion' );
    }

}
