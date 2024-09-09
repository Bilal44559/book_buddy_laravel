@extends('layouts.web.master')

@section('content')
@if(count($books) > 0)
@foreach ($books as $book)
    <div class="templatemo_product_box">
        <h1>{{$book->title}}  <span>(by {{$book->author->name}}r)</span></h1>
        @if(!empty($book->image))
        <img src="{{ asset('storage/'.$book->image)}}"  width="100" height="150" alt="image" />
        @else
        <img src="images/templatemo_image_01.jpg" alt="image" />
        @endif
        <div class="product_info">
            <p>{{ substr($book->description,0,50)}}...</p>
        {{-- <h3>$55</h3> --}}
            <div class="buy_now_button"><a href="{{ route('detail',$book->id) }}">Detail</a></div>
            {{-- <div class="detail_button"><a href="{{ url('/detail') }}">Detail</a></div> --}}
        </div>
        <div class="cleaner">&nbsp;</div>
    </div>

    <div class="cleaner_with_width">&nbsp;</div>
@endforeach
@endif
@endsection
