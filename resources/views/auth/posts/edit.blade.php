@extends('layouts.auth') 
@section('title', 'Edit Post | Admin Dashboard') 



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
				<h2>Edit Post</h2>
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

    

                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PATCH')
                    <div class="form-group">
                      <label >Title</label>
                      <input type="text" name="title" value="{{ old('title' , $post->title) }}" class="form-control" placeholder="Title" >
                     
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" class="form-control" cols="30" rows="3" style="resize: none" placeholder="description">{{ old('description' , $post->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Publish</label>
                        <select name="status" class="form-control"  placeholder="description">
                            <option value="" disabled selected></option>
                            <option @selected(old('status', $post->status) == 1) value="1">Publish</option>
                            <option @selected(old('status', $post->status) == 0) value="0">Draft</option>
                        </select>
                      </div>

                       {{-- <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control"  placeholder="description">
                            <option value="" disabled selected> Choose Option</option>
                            <option value="" disabled selected></option>
                          @if (count($categories) > 0)
                          @foreach ($categories as $category)
                          <option @selected(old('category', $post->category) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                          
                          @endforeach
                          @endif

                        </select>
                      </div>  --}}



                      <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" id="category" placeholder="description">
                            @if (count($categories) > 0)
                                @foreach ($categories as $category)
                                    <option {{ $post->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                      </div>
                      


                      {{-- <div class="form-group">
                        <label>Tags</label>
                        <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true"  >
                        
                            <option value="" disabled selected> Choose Option</option>
                            @if (count($tags) > 0)
                            @foreach ($tags as $tag)
                            
                            @foreach($post->tags as $postTag)
                            <option @selected(old('tags', $postTag->id) == $tag->id) value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                            @php
                            continue;
                        @endphp
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            
                            @endforeach
                            @endif

                        </select>
                      </div> --}}
{{-- 
                      <div class="form-group">
                        <label>Tags</label>
                        <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true"  >
                            <option value="" disabled selected> Choose Option</option>
                          @if (count($tags) > 0)
                          @foreach ($tags as $tag)
                          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                          
                          @endforeach
                          @endif
                        </select>
                      </div> --}}

                      <div class="form-group">
                        <label>Tags1</label>
                        <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true">
                            {{-- <option value="" disabled selected>Choose Option</option> --}}
                            @if (count($tags) > 0)
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>



                      {{-- <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true">
                        <!-- ... your other options ... -->
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $tagIds) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select> --}}


                    
                      {{-- <div class="form-group">
                        <label >Images</label>
                        <input type="file" name="file" value="{{ old('file') }}" class="form-control"  >
                       
                      </div> --}}

                      <div class="form-group">
                        <label>Images</label>
                        @if ($post->gallery && $post->gallery->image)
                            <p>Previous Image:</p>
                            <img src="{{ asset('storage/auth/posts/' . $post->gallery->image) }}" alt="Previous Image">
                        @endif
                        <input type="file" name="file" class="form-control">
                    </div>

                    {{-- <div class="form-group">
                      <label>Images</label>
                      @if ($post->gallery && $post->gallery->image)
                          <p>Previous Image: {{ $post->gallery->image }}</p>
                      @endif
                      <input type="file" name="file" class="form-control">
                  </div> --}}
                    
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