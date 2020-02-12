@extends("crudbooster::dev_layouts.layout")
@section("content")

    <div class="box box-default mt-10">
        <div class="box-body">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>Author</th>
                        <th>Install</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $row)
                        <tr>
                            <td>
                                @if($row['icon'])
                                    <i class="{{ $row['icon'] }}"></i>
                                @endif
                                {{ $row['name'] }}</td>
                            <td>{{ $row['description'] }}</td>
                            <td>{{ $row['version'] }}
                                @if(isset($row['changelog']))
                                    <a href="javascript:;" title="Changelog {{$row['version']}}:&#013;{{ $row['changelog'] }}"><i class="fa fa-question-circle"></i></a>
                                @endif
                            </td>
                            <td>
                                @if(isset($row['author_homepage']))
                                    <a target="_blank" href="{{ $row['author_homepage'] }}">{{ $row['author'] }}</a>
                                @else
                                    {{ $row['author'] }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection