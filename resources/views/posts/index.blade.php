@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end">
        <a href="{{url('posts/create')}}" class="btn btn-success float-right mb-2">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            @if(count($posts)>0)
                <table class="table">
                    <thead>
                        <th>
                            Image
                        </th>
                        <th>
                            Title
                        </th>
                        <th>Category</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                                <img width="60px" height="60px" src="{{url('storage/'.$post->image)}}" alt="">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>{{$post->category->name}}</td>
                            @if($post->trashed())
                                <td>
                                    <form action="{{ url('restoretrashed/'.$post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"  class="btn btn-info btn-sm">Restore</button>
                                    </form>
                                    
                                    
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    
                                </td>

                            @endif
                            <td>
                                <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{$post->trashed() ? 'Delete' : 'Trash'}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr></tr>
                    </tbody>
                </table>

            @else

                <h3 class="text-center">No Posts Yet</h3>
            @endif
        </div>
    </div>
@endsection