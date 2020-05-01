@extends('layouts.app')

@section('content')
    <div class="alert-danger">
        @if(session()->has('error')) 
            <ul class="list-group">
                <li class="list-group-item text-danger">{{session('error')}}</li>
            </ul>
                
        @endif
        
    </div>
    <div class="d-flex justify-content-end">
    <a href="{{url('tags/create')}}" class="btn btn-success float-right mb-2">Add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if(count($tags)>0)

                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Posts Count</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>{{$tag->posts()->count()}}</td>
                                <td>
                                    <a href="{{ route('tags.edit',$tag->id) }}" class="btn-info btn-sm pull-right">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="handledelete({{ $tag->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Tags Yet</h3>
            @endif
            
         

            <form action="" method="post" id='deletecategoryform'>
                @csrf
                @method('DELETE');
                <!-- Modal -->
                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodallabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletemodallabel">Delete Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure.You Want to delete Tag</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes,Delete</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>

        </div>
    </div>
    
@endsection 

@section('scripts')
    <script>
        function handledelete(id)
        {
            
            var form=document.getElementById('deletecategoryform');
            form.action='tags/'+id;
            
            $('#deletemodal').modal('show');
        }
    </script>

@endsection