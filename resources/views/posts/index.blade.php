@extends('layouts.base')
@section('content')
<div class="row pt-10">
    @include('layouts.session-messages')
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
        @if(count($posts) > 0)
            @foreach($posts as $post)
            <div class="col-lg-6">
                <!-- Blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted">{{ date_format($post->created_at, ('jS M, Y')) }}</div>
                        <h2 class="card-title h4 text-justified" >{{$post->title}}</h2>
                        <p class="card-text">{{ $post->post }}</p>
                        <a class="btn btn-primary btn-sm" href="{{route('blog.show', $post->id)}}">Read more →</a>
                    </div>
                </div>
            </div>
            @endforeach

            @else
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">No post found</h1>
                        <p class="lead">There are no post on the system.</p>
                        <p class="lead"><a class="btn btn-primary btn-sm" href="{{route('blog.new')}}" role="button">Post a Blog</a></p>
                    </div>
                </div>
            @endif
        </div>
        <!-- Pagination-->
        <nav aria-label="Pagination">
            <hr class="my-0" />
            <ul class="pagination justify-content-center my-4">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                <li class="page-item"><a class="page-link" href="#!">15</a></li>
                <li class="page-item"><a class="page-link" href="#!">Older</a></li>
            </ul>
        </nav>
    </div>
    <!-- Side widgets-->
    @include('layouts.sidewidgets')
</div>
@endsection
