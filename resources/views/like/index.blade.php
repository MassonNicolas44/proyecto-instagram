@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

<h1>Imagenes a las que le di Like</h1>

        @foreach($likes as $like)
            @include('includes.image',['image'=>$like->image])
        @endforeach

        <div class="clearfix"></div>
            {{ $likes->links() }}
        </div>

        </div>
    </div>
</div>
@endsection
