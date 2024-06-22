@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Blog Posts') }}</div>

                <div class="card-body">
                    @include('layouts.session-messages')


                </div>
            </div>
        </div>

        @include('layouts.sidewidgets')
    </div>
</div>
@endsection
