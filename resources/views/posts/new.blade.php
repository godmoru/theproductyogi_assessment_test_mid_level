@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Blog Posts') }}</div>
                <div class="card-body">
                    @include('layouts.session-messages')
                    <form method="post" action="{{route('blog.create')}}">
                        @csrf
                        <div class="form-group">
                            <label for="posttitle">Title</label>
                            <input type="text" name="title" class="form-control" id="posttitle" placeholder="New World Seekers">
                        </div>
                        <div class="form-group">
                            <label for="postbody">Post Conetnt</label>
                            <textarea class="form-control" name="postbody" id="postbody" rows="3"></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Post</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('layouts.sidewidgets')
    </div>
@endsection
