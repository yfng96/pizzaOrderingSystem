<?php
use App\Common;
?>
@extends('layouts.main')
@section('content')

<div class="content">
    <h2 style="padding:20px">USER</h2>
    @if (session('success'))
        <div class="alert alert-success" style="margin-top: 20px; width:100%">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="panel-body">
        
        <div>
            <a href="{{ route('admin.user.create') }}" class="btn btn-success" style="margin:0px 10px 10px">
                Add new user
            </a>
            <div class="pull-right" style="margin:0px 10px">{{ $users->links() }}</div>
        </div>
            
            <div style="background:#ddd;padding:5px;margin:10px">
                <table class="table-striped content-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $i+1 }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $user->phone }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ Common::$roles[$user->role] }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <a class="btn btn-info" style="margin:5px" href="{{ route('admin.user.edit', $user->id) }}">Edit</a>
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