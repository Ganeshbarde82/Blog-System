@extends('layouts.auth') 
@section('title', 'Create Post | Admin Dashboard') 



@section('styles')

<link rel="stylesheet" href="{{ asset('assets\auth\css\multi-dropdown.css') }}">

{{-- D:\Blog-System\blog-system\public\assets\auth\css\multi-dropdown.css --}}

@endsection


@section('content')

      
<div class="content-wrapper">
	<div class="content">
		<!-- Masked Input -->
		<div class="card card-default">
			<div class="card-header">
				<h2>Create Post</h2>
				{{-- <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button" aria-expanded="false" aria-controls="collapse-input-musk"> </a> --}}
			</div>
			<div class="card-body"> 


 
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label >Title</label>
                      <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title" >
                     
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" class="form-control" cols="30" rows="3" style="resize: none" placeholder="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Publish</label>
                        <select name="status" class="form-control"  placeholder="description">
                            <option value="" disabled selected></option>
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
                        </select>
                      </div>

                      <div class="form-group">      
                        <label>Category</label>
                        {{-- category_id not  use in name    --}}
                   <select name="category" class="form-control"  placeholder="description">
                            <option value="" disabled selected> Choose Option</option>
                          @if (count($categories) > 0)
                          @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          
                          @endforeach
                          @endif

                        </select>
                      </div>


                      <div class="form-group">
                        <label>Tags</label>
                          {{-- multiple tag enable [ ] --}}
                        <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true"  >
                        {{-- <select name="tags" class="form-control selectpicker" multiple data-live-search="true" > --}}
                            <option value="" disabled selected> Choose Option</option>
                          @if (count($tags) > 0)
                          @foreach ($tags as $tag)
                          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                          
                          @endforeach
                          @endif

                         
                          
                        </select>
                      </div>
                      <div class="form-group">
                        <label >Images</label>
                        <input type="file" name="file" value="{{ old('file') }}" class="form-control"  >
                       
                      </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
		</div>
	</div> 
    @endsection

    
@section('scripts')

{{-- <link rel="stylesheet" href="{{ asset('assets/auth/js/multi-dropdown.js') }}"> --}}

<script src="{{ asset('assets/auth/js/multi-dropdown.js') }}"> </script>

@endsection