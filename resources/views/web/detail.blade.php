@extends('layouts.web.master')

@section('content')
<h1>{{$book->title}} <span>(by {{$book->author->name}})</span></h1>
            <div class="image_panel"><img src="{{asset('/')}}images/templatemo_image_02.jpg" alt="CSS Template" width="100" height="150" /></div>
          <h2>Read the lessons - Watch the videos - Do the exercises</h2>
            <ul>
	            <li>By <a href="#">{{$book->author->name}}</a></li>
            	<li>{{date("M d,Y",strtotime($book->publish_date))}}</li>
                {{-- <li>Pages: 498</li> --}}
                {{-- <li>ISBN 10: 0-496-91612-0 | ISBN 13: 9780492518154</li> --}}
            </ul>
            
            <p>{{ $book->description }}</p>
             <div class="cleaner_with_height">&nbsp;</div>
@endsection
