@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header"> Subir Imagen </div>


                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('image.save') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="image_path" class="col-md-2 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-9">
                                    <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }} " required/>
                                     @if ($errors->has('image_path'))
                                        <span class="invalid-feeback" role="alert">
                                            <strong> {{$errors->first('image_path')}} </strong>
                                        </span>
                                     @endif
                                </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-9">
                                    <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " required/></textarea>
                          
                        

                        @if ($errors->has('description'))
                            <span class="invalid-feeback" role="alert">
                                <strong> {{$errors->first('description')}} </strong>
                            </span>
                        @endif
                        </div>
                        </div>

                        <div class="form-group row">
                                <div class="col-md-6 offset-md-2">
                                    <input type="submit" class="btn btn-primary" value="Subir imagen" />
                                </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
