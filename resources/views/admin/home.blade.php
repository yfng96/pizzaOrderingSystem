@extends('layouts.main')
@section('content')

<div class="content">
    
    <div class="row" style="padding-top:20px">
        @if (session('unauthorized'))
            <div class="alert alert-danger col-md-8 col-md-offset-2" style="margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('unauthorized') }}
            </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
