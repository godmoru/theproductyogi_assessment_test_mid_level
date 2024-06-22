<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="button">Search</button>
            </div>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#! ">Web Design</a></li>
                        <li><a href="#!">HTML</a></li>
                        <li><a href="#!">Freebies</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">JavaScript</a></li>
                        <li><a href="#!">CSS</a></li>
                        <li><a href="#!">Tutorials</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
            <div class="card-header">{{ __('Recent Posts') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @php $posts = \App\Models\Post::all(); @endphp
                @if(count($posts) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td><a href="{{route('blog.show', $post->id)}}">{{$post->title}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        </div>
</div>
