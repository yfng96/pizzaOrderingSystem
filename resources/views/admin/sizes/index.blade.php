@extends('layouts.main')
@section('content')

<div class="content">
    <h2 style="padding:20px">SIZE</h2>
    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <div class="panel-body">
        
            <div>
                <a href="{{ route('admin.size.create') }}" class="btn btn-success" style="margin:0px 10px 10px">
                    Add new size
                </a>
            </div>
            
            <div style="background:#ddd;padding:5px;margin:10px">
                <table class="table-striped content-table">
                    <thead>
                        <tr>
                            <th class="col-sm-2">No.</th>
                            <th class="col-sm-4">Name</th>
                            <th class="col-sm-4">Rate</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($sizes) > 0)
                            @foreach ($sizes as $i => $size)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $i+1 }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $size->name }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                        {{ number_format($size->rate, 2) }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <a class="btn btn-info" style="margin:5px" href="{{ route('admin.size.edit', $size->id) }}">Edit</a>
                                    </td>
                                    <td class="table-text">
                                        <a class="btn btn-danger" style="margin:5px" href="{{ route('admin.size.delete', $size->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan=5 style="padding:20px;text-align:center">No record found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        
    </div>
</div>

@endsection