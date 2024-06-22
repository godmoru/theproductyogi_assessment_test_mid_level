@extends('layouts.base')

@section('content')
<br><br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header container-fluid">{{ $post->title }}</div>
            <div class="float-right">
                <a href="{{route('blog.edit', $post->id)}}" class="btn btn-sm btn-warning">Edit</a>
            </div>
            <div class="card-body">
            @include('layouts.session-messages')
                <!-- <p>{{__('Title: ') .$post->slug }} </p><br> -->
                <p>{{ __('Post body: '). $post->post }} </p><br>
                <p>{{ __('Author: '). $post->user->name ?? "" }} posted on: {{date_format($post->created_at, ('jS M, Y'))}}</p>
                <hr>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                            <div class="card-body p-4">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <form method="post" action="{{route('blog.addcomment')}}">
                                        @csrf
                                        <input type="hidden" name="postId" value="{{$post->id}}">
                                        <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Type comment..."></textarea><br>
                                        <button type="submit" class="btn btn-primary">Comment</button>
                                    </form>
                                </div>
                                <br>
                                @foreach($post->comments as $comment)
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{$comment->comment ?? ""}}</p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="small mb-0 ms-2">{{$comment->post->user->name}}</p>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="small text-muted mb-0">{{date_format($comment->created_at, ('jS M, Y'))}}</p>
                                                <i class="far fa-thumbs-up ms-2 fa-xs text-body" style="margin-top: -0.16rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @include('layouts.sidewidgets')
</div>
@endsection
