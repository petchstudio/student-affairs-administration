@extends('layouts.member')

@section('link')
    @parent
    <link href="{{ asset('assets/js/plugins/jquery.bootgrid/1.3.1/jquery.bootgrid.min.css') }}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{{ asset('assets/js/plugins/jquery.bootgrid/1.3.1/jquery.bootgrid.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var grid = $("#table-activity").bootgrid({
            ajax: true,
            ajaxSettings: {
                method: "GET",
            },
            /*post: function ()
            {
                return {
                    id: "...",
                };
            },*/
            url: "{!! url('api/member/activities-category') !!}",
            formatters: {
                "commands": function(column, row) {
                    return '<form action="{{ url('member/activities-category') }}/' + row.id +'" method="POST">{{ csrf_field() }}{{ method_field('DELETE') }}<a href="{{ url('/member/activities-category') }}/' + row.id +'/edit" class="btn btn-xs btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a><button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></form>';
                }
            },
        });
    });
    </script>
@stop

@section('container')

    @include('includes.alert-response-session')

    <div class="page-title">
        <div class="title_left">
            <h3>ประเภทกิจกรรม</h3>
        </div>
    </div>
    <table id="table-activity" class="table table-condensed table-hover table-striped">
    	<thead>
            <tr>
                <th data-column-id="id" data-width="200px">รหัสประเภทกิจกรรม</th>
                <th data-column-id="name">ชื่อประเภทกิจกรรม</th>
                <th data-formatter="commands" data-sortable="false" data-width="75px">&nbsp;</th>
            </tr>
        </thead>
    </table>
@endsection