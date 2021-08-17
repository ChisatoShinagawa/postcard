<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Order;
use App\Message_card;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view( 'dashboard' );
    }

    public function entryImportFile()
    {
        return view( 'entry_inport_file' );
    }

    public function importCsv( Request $request )
    {
        // $file = $request->file( 'file' );var_dump($file->pathName());exit;
        // $path = Storage::putFileAs( '/csv', $file->pathName, date( 'Y/m/d', time() ).'.csv' );//できない
        
        if( !$request->file( 'new_data' ) ){
            return redirect()->back();
        }

        // delete previous data ??
        
        // save image in storage with provisional id as file name
        $file = $request->file( 'new_data' );
        $name = date( 'Y-m-d', time() ).'.csv';
        $target_path = storage_path( '/app/public/csv/');
        $file->move( $target_path, $name );
        $filepath = $target_path.$name;//var_dump($filepath);exit;

        //$filepath = storage_path( 'app/public/test.csv' );
        $shipArr = $this->csvToArray( $filepath );
        
        for( $i = 0; $i < count( $shipArr ); $i++ ){
           $data = $shipArr[$i];
           //var_dump(date( 'Y-m-d H:i:s', strtotime( $data['shipping_at'] ) ));exit;
           Order::firstOrCreate( [
               'id'      => $data['order_num'],
               'order_at'=> date( 'Y-m-d H:i:s', strtotime( $data['order_at'] ) ),
               'delivery_at' => date( 'Y-m-d H:i:s', strtotime( $data['shipping_at'] ) ),               
           ] );
        }
        return redirect()->route( 'order_list' );
    }

    public function csvToArray( $filename, $delimiter = ',' )
    {
        //var_dump( $filename );exit;

        if( !file_exists( $filename ) || !is_readable( $filename ) ){
            return false;
        }
        $data = array();
        $handle = null;
        $header = null;
        if( ( $handle = fopen( $filename, 'r' ) ) === false ){
            return false;
        }
        while( ( $row = fgetcsv( $handle, 1000, $delimiter ) ) !== false ){
            if( !$header ){
                $header = $row;
                continue;
            }
            $data[] = array_combine( $header, $row );
        }
        fclose( $handle );
        return $data;
    }

    public function goDashboard()
    {
        $view = view( 'dashboard' );
        return $view;
    }

    public function showOrderList()
    {
        $query = Order::query();
        $orders = $query->orderBy( 'order_at', 'desc' )->get();

        $view = view( 'order_list' );
        $view->with( 'orders', $orders );
        return $view;
    }

    public function showMessageList( Request $request )
    {
        if( !empty( $request->input( 'order_id_keyword' ) ) ){
            $keyword_order_id = $request->input( 'order_id_keyword' );
        }elseif( !empty( $request->input( 'message_id_keyword' ) ) ){
            $keyword_message_id = $request->input( 'message_id_keyword' );
        }elseif( !empty( $request->input( 'date_keyword' ) ) ){
            $keyword_date = $request->input( 'date_keyword' );
        }

        if( !empty( $keyword_order_id ) ){
            $orders = DB::table( 'orders' )
                    ->leftjoin( 'message_cards', function( $query ){
                        $query->whereRaw( 'orders.id = message_cards.order_id' );
                    } )
                    ->select( DB::raw( 'orders.id as order_id' ),
                                'order_at',
                                'delivery_at',
                                DB::raw( 'message_cards.id as message_card_id' ),
                                'image',
                                'pdf',
                                'download_at', )
                    ->where( 'order_id', 'like', "%{$keyword_order_id}%" )
                    ->orderBy( 'delivery_at', 'desc' )
                    ->orderBy( 'order_id', 'desc' )
                    ->orderBy( 'message_card_id', 'desc' )
                    ->paginate( 15 );
        } elseif( !empty( $keyword_message_id ) ){
            $orders = DB::table( 'orders' )
                    ->leftjoin( 'message_cards', function( $query ){
                        $query->whereRaw( 'orders.id = message_cards.order_id' );
                    } )
                    ->select( DB::raw( 'orders.id as order_id' ),
                                'order_at',
                                'delivery_at',
                                DB::raw( 'message_cards.id as message_card_id' ),
                                'image',
                                'pdf',
                                'download_at', )
                    ->where( 'message_card_id', 'like', "%{$keyword_message_id}%" )
                    ->orderBy( 'delivery_at', 'desc' )
                    ->orderBy( 'order_id', 'desc' )
                    ->orderBy( 'message_card_id', 'desc' )
                    ->paginate( 15 );
        } elseif( !empty( $keyword_date ) ){
            $orders = DB::table( 'orders' )
                    ->leftjoin( 'message_cards', function( $query ){
                        $query->whereRaw( 'orders.id = message_cards.order_id' );
                    } )
                    ->select( DB::raw( 'orders.id as order_id' ),
                                'order_at',
                                'delivery_at',
                                DB::raw( 'message_cards.id as message_card_id' ),
                                'image',
                                'pdf',
                                'download_at', )
                    ->whereDate( 'delivery_at', $keyword_date )
                    ->orderBy( 'delivery_at', 'desc' )
                    ->orderBy( 'order_id', 'desc' )
                    ->orderBy( 'message_card_id', 'desc' )
                    ->paginate( 15 );
        } else{
            $orders = DB::table( 'orders' )
                        ->leftjoin( 'message_cards', function( $query ){
                            $query->whereRaw( 'orders.id = message_cards.order_id' );
                        } )
                        ->select( DB::raw( 'orders.id as order_id' ),
                                    'order_at',
                                    'delivery_at',
                                    DB::raw( 'message_cards.id as message_card_id' ),
                                    'image',
                                    'pdf',
                                    'download_at', )
                        ->where( 'pdf', 'like', '%.pdf' )
                        ->orderBy( 'delivery_at', 'desc' )
                        ->orderBy( 'order_id', 'desc' )
                        ->orderBy( 'message_card_id', 'desc' )
                        ->paginate( 15 );
        }

        // $dates = [ 'delivery_at', 'order_at', 'download_at' ];
        // $dates['delivery_at'] = datetime( 'Y/m/d H:i:s', strtotime( $orders->delevery ) );var_dump($date)
        /**
         * $orders = DB::table( 'orders' )
         *              ->leftjoin( 'message_cards, function( $query ){
         *                  $query->whereRaw( 'orders.id = message_cards.order_id' );
         *              } )
         *              ->select( DB::raw( 'orders.id as id' ), 'order_at', 'delivery_at' )
         *              ->get();
         */
        $view = view( 'message_list' );
        $view->with( 'orders', $orders );
        return $view;
    }

    /*public function showPreview( Request $request, $id )
    {        
        // get a main image file
        $message_card_info = Message_card::find( $id );
        $image = $message_card_info->image;
        $message_to = $message_card_info->message_to;
        $message_content = $message_card_info->message_content;
        $message_from = $message_card_info->message_from;

        // open an template file
        $img = ImageManagerStatic::make( storage_path( 'app/public/img/exaFrame.jpg' ) );

        // make insert image
        $insert_img = ImageManagerStatic::make( storage_path( 'app/public/img/uploads/'.$image ) );

        // crop and resize
        $insert_img->fit( 567, 340 ); // use when want to zoom image after crop        
        $img->insert( $insert_img, 'top-left', 97, 38 );
        
            // $insert_img->fit( 567, 340, function( $constraint ){ //use when don't want to zoom image
            //     $constraint->upsize();
            // } );
    
        // save preview image in laravel storage( without message ) 
        //$fname = 'img/previews/'.$image;
        $pre_name = storage_path( 'app/public/img/previews/'.$image );
        $img->save( $pre_name );

        $url_img = '/l6x'.Storage::url( 'img/previews/'.$image );
       
        $num = mb_strlen( $message_content );
       
        // 3 rows
        if( 43 > $num && $num > 28 ){
            $message_content_3 = $message_content;
        }
        // 2 rows
        if( 29 > $num && $num > 14 ){
            $message_content_2 = $message_content;
        }
        // 1 rows
        if( 15 > $num && $num > 0 ){
            $message_content_1 = $message_content;
        }

        $view = view( 'preview' );        
        $view->with( 'message_to', $message_to );
        if( !empty( $message_content_4 ) ){
            $view->with( 'message_content_4', $message_content_4 );
        }
        $view->with( 'message_to', $message_to );
        if( !empty( $message_content_3 ) ){
            $view->with( 'message_content_3', $message_content_3 );
        }
        $view->with( 'message_to', $message_to );
        if( !empty( $message_content_2 ) ){
            $view->with( 'message_content_2', $message_content_2 );
        }
        $view->with( 'message_to', $message_to );
        if( !empty( $message_content_1 ) ){
            $view->with( 'message_content_1', $message_content_1 );
        }
        $view->with( 'message_from', $message_from );
        $view->with( 'url_img', $url_img );
        return $view;  

    }**/

    public function singleDownloadProc( Request $request, Response $response, $id )
    {
        // Download a target file
        $message_card = Message_card::find( $id );
        $message_card->download_at = date( "Y-m-d H:i:s" ); // 登録できないときがある 1行上のvar_dumpを通る$idと通らないものがある
        $message_card->save(); //32, 31は通らない　35, 34はきちんと通り画面に留まりダウンロードまでいかない
        return response()->download( storage_path().'/app/public/pdf/'.$message_card->pdf );         
    }

    public function multiDawnloadProc( Request $request, Response $response )
    {
        Storage::delete( 'message_card.zip' );
        
        // get an array of id
        $files = [];
        $id = $request->input( 'download' );
        // get pdf file names from database        
        foreach( $id as $num ){
            //$files[] = Message_card::where( 'id', $num )->value( 'pdf' );var_dump($files);exit;

            $message_card = Message_card::where( 'id', $num )->first();//var_dump($message_card->pdf);exit;
            $files[] = $message_card->pdf;
            $message_card->download_at = date( "Y-m-d H:i:s", time() );
            $message_card->save();                
        }

        //$zip_file = 'message_card.zip';
        //$zip_file = storage_path( 'app/public/message_card.zip' ); //C:\xampp\l6x\storage\app/public/message_card.zip
        $zip_file = 'C:/xampp/l6x/storage/app/public/message_card.zip'; 

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open( $zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE );

        foreach( $files as $file ){
            $message_card_file = '/app/public/pdf/'.$file;
            
            // Adding file: second parameter is what will the path inside of the archive
            // So it will create another folder called "storage/" inside Zip, and put the file there
            $zip->addFile( storage_path( $message_card_file ), $file );
        }

        $zip->close();
        
        // return the file immediately after download
        return response()->download( storage_path().'/app/public/message_card.zip' );
        //return response()->download( $zip_file );
    }
}
