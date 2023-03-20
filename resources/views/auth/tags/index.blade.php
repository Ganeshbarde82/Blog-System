@extends('layouts.auth') 

@section('title', 'Tags') 

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

<link href="{{ asset("assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css") }}" rel="stylesheet" />

@endsection


@section('content')

      
<div class="content-wrapper">
	<div class="content">
		<!-- Masked Input -->
		<div class="card card-default">
			<div class="card-header">
				<h2>Tags</h2>
				{{-- <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button" aria-expanded="false" aria-controls="collapse-input-musk"> </a> --}}
			</div>
      @if (Session::has('alert-success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ Session::get('alert-success') }}
      </div>
      @endif
     
      
			<div class="card-body"> 

                @if (count($tags)>0)
                <table class="table" id="posts">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                      
                       
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                      <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        {{-- <td>{{ $category->created_at }}</td> --}}
                      
                          </form>
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else 
                  <h3 class="text-center"> Not Found </h3>
                  @endif
       
          
     </div>
	</div>
	</div> 
</div>
    @endsection


    @section('scripts')



<script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"> </script>
<script>
  $(document).ready(function(){
    $('#posts').DataTable({
      "bLengthChange": false
    });

  });
</script>
@endsection