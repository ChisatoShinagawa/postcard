@extends( 'layouts.admin' )
@section( 'content' )
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>            
                <td style="width: 100px;">Order ID</td>
                <td style="width: 100px;">ID</td>
                <td style="width: 100px;">Delvery Date</td>
                <td style="width: 100px;">Download date</td>        
                <td>PDF</td>
                <td style="width: 50px;">check</td>
                <td style="width: 300px;">Action</td>            
            </tr>
            <form action="{{ route('multi_download_proc') }}" method="post">
            @csrf
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="submit" class="btn btn-info" value="Multi Download"></td>
                    <td></td>
                </tr>
                @foreach( $orders as $order )
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->message_card_id }}</td>
                    <td>{{ date( 'Y/m/d', strtotime( $order->delivery_at ) ) }}</td>             
                    <td>{{ $order->download_at ? date( 'Y/m/d', strtotime( $order->download_at ) ) : '' }}</td>
                    <td>{{ $order->pdf }}</td>
                    <td><input type="checkbox" name="download[]" value="{{ $order->message_card_id }}"></td>
                    <td>
                        <a href="{{ route( 'single_download_proc', intval($order->message_card_id) ) }}" class="btn btn-info">download</a>
                        <a href="{{ route( 'preview', ['lang'=>'ja', 'id' => intval($order->message_card_id)] ) }}" class="btn btn-success ml-1" target="_blank">preview</a>                        
                    </td>  
                </tr>
                @endforeach
            </form>
        </table>
        <div class="pagination justify-content-center">
        {{ $orders->links() }}
        </div>
        {{--@include( 'pagenation', ['pager' => $order] )--}}
    </div>
</section>
@endsection

{{--@foreach( $orders as $order )
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->delivery_day->format('Y/m/d') }}</td>             
                <td>{{ $order->order_at->format('Y/m/d') }}</td>
                <td><table>
                @foreach( $order->message_cards as $card )
                    <tr>
                        <td>{{ $card->id }}</td>
                        <td>{{ $card->pdf }}</td>
                        <td><input type="checkbox" name="download[]" value="{{ $card->id }}"></td>
                        <td>
                            <a href="{{ route( 'single_download_proc', $card->id ) }}" class="btn btn-info">download</a>
                            <a href="{{ route( 'preview', $card->id )}}" class="btn btn-success ml-1" target="_blank">preview</a>
                        </td>
                    </tr>
                @endforeach
                </table>
                </td>
            </tr>
            @endforeach
            
            @foreach( $orders as $order )
            <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->message_cards[0]->id }}</td>
                    <td>{{ $order->delivery_day->format('Y/m/d') }}</td>             
                    <td>{{ $order->order_at->format('Y/m/d') }}</td>
                    <td>{{ $order->message_cards[0]->pdf }}</td>
                    <td><input type="checkbox" name="download[]" value="{{ $order->message_cards->id }}"></td>
                    <td>
                        <a href="{{ route( 'single_download_proc', $order->$order->message_cards->id ) }}" class="btn btn-info">download</a>
                        <a href="{{ route( 'preview', $order->message_cards->id )}}" class="btn btn-success ml-1" target="_blank">preview</a>
                    </td>  
                </tr>
            @endforeach --}}
            {{--@foreach( $lists as $list )
            <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->order_id }}</td>
                    <td>{{ $list->delivery_day }}</td>             
                    <td>{{ $list->order_at->format('Y/m/d') }}</td>
                    <td>{{ $list->pdf }}</td>
                    <td><input type="checkbox" name="download[]" value="{{ $list->id }}"></td>
                    <td>
                        <a href="{{ route('single_download_proc', $list->id ) }}" class="btn btn-info">download</a>
                        <a href="{{ route( 'preview', $list->id )}}" class="btn btn-success ml-1" target="_blank">preview</a>
                    </td>  
                </tr>
            @endforeach
            @foreach( $orders as $order )
                <tr>
                    <td>{{ $order->id }}</td>                    
                    @if( $order->message_cards != null )
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>                        
                        @foreach( $order->message_cards as $message_card )
                            <tr>
                                <td></td>
                                <td>{{ $message_card->id }}</td>
                                <td>{{ $order->delivery_day }}</td>
                                <td>{{ $order->order_at }}</td>
                                <td>{{ $message_card->pdf }}</td>
                                <td><input type="checkbox" name="download[]" value="{{ $order->id }}"></td>
                                <td>
                                    <a href="{{ route('single_download_proc', $order->id ) }}" class="btn btn-info">download</a>
                                    <a href="{{ route( 'preview', $order->id )}}" class="btn btn-success ml-1" target="_blank">preview</a>
                                </td>
                            </tr>
                        @endforeach                        
                    @endif                    
                </tr>
            @endforeach--}}