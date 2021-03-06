@extends('layouts.app')

@section('content')
    <div class="alert-danger">
        @if(count($errors)>0)
        
            @foreach($errors->all() as $error)
            
                {{ $error }}
            @endforeach
        @endif
    
    </div>
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Update Post' : 'Create Post'}}
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))

                    @method('PUT')
                @endif
                <div class="forn-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : ''}}">
                </div>
                <div class="forn-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : ''}}</textarea>
                </div>
                <div class="forn-group">
                    <label for="content">Content</label>
                    <!-- <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->content : ''}}</textarea> -->
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="forn-group">
                    <label for="published-at">Published-at</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : ''}}">
                </div>
                <br>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/'.$post->image)}}" alt="" style="width:100%">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if(isset($post))
                                @if($category->id==$post->category_id)
                                    selected
                                @endif
                            
                            @endif
                        >
                            {{$category->name}}
                        </option>
                        @endforeach
                        
                    
                    </select>
                </div>
                <br>
                <div class="form-group">
                    
                    @if(count($tags)>0)
                    <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if(isset($post))
                                        @if($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    
                                >{{$tag->name}}</option>
                            @endforeach
                        </select>
                    @endif
                    
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{ isset($post) ? 'Update Post' : ' Add Post'}}
                       
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection 
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at",{
            enableTime:true,
            enableSeconds:true
        })
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection