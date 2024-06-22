@extends('layouts.base')

@section('content')
<br><br>
    <div class="row justify-content-center mt-10">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editing ') .$post->title }}</div>
                <div class="card-body">
                    @include('layouts.session-messages')
                    <form method="post" action="{{route('blog.update')}}">
                        <input type="hidden" name="postId" value="{{$post->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="posttitle">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
                        </div>
                        <div class="form-group">
                            <label for="postbody">Post Conetnt</label>
                            <textarea class="form-control" name="postbody" id="postbody" rows="3">{{$post->post}}</textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('layouts.sidewidgets')
    </div>
@endsection
