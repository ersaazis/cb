@extends('crud::themes.adminlte.layout.layout')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Notifications</h3>
            <div class="box-tools">
                <a href="{{cb()->getAdminUrl('notification/delete')}}" class="btn btn-danger btn-sm pull-right"><i class="fa fa-times"></i></a>
                <a href="{{cb()->getAdminUrl('notification/read')}}" class="btn btn-success btn-sm pull-right ml-1" style="margin-right:1rem"><i class="fa fa-check"></i></a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-dark">
                <tr>
                    <th width='20'>No</th>
                    <th>Notification</th>
                </tr>
                @php
                    $i=1;
                @endphp
                @foreach ($notifUnRead as $item)
                <tr class="bg-info">
                    <td>{{$i++}}</td>
                    <td><a href="{{cb()->getAdminUrl('notification/go/'.$item->id)}}">{{$item->content}}</a></td>
                </tr>                        
                @endforeach
                @foreach ($notifRead as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href="{{cb()->getAdminUrl('notification/go/'.$item->id)}}">{{$item->content}}</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection