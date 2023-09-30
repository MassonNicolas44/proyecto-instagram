@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card pub_image">
                <div class="card-header">
                    @if ($image->user->image)                 
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
                    </div>
                    @endif
                <div class="data-user">          
                    {{ $image->user->name.' '.$image->user->surname }}
                    <span class="nickname">
                        {{' |@'.$image->user->nick}}
                    </span>
                </div> 
            </div>
            
            <div class="card-body">
                <div class="image-container">
                    <img src="{{ route('image.file',['filename'=>$image->image_path]) }}"/>
                </div>

                <div class="likes">
                    <img src="{{asset('img/corazonNegro.png')}}"/>
                </div>

                <div class="description">
                    <span class="nickname"> {{ '@'.$image->user->nick }} </span>
                    <span class="nickname" date> {{' | '. \FormatTime:LongTimeFilter{$image->create_at}  }} </span>
                   <p> {{ $image->description }} </p>
                </div>
                <a href="" class="btn btn-info btn-comments">Comentarios ({{count($image->comments)}}) </a>
            </div>

        </div>
    </div>
</div>
@endsection
