@extends('layouts.app')

@section('content')

<div class="container">             
    <form action="/h" enctype="multipart/form-data" method="post">
    @csrf

        <div class="row">
            <label for="har" class="col-md-4 col-form-label">Har file</label>
            <input type="file" accept=".har" class="form-control-file" id="har" name="har">

            @error('har')
                <strong>{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <button class="btn btn-primary" style="margin:10px 10px 10px 0px;">Upload to Server</button>
            
        </div>
    </form>

</div>
        
        

@endsection