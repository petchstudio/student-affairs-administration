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
            url: "{!! url('api/member/activities') !!}",
            formatters: {
                "event": function(column, row) {
                    var year = parseInt(moment(row.event_at).format("YYYY"))+543;
                    return moment(row.event_at).format("DD/MM")+"/"+year;
                },
                "term-year": function(column, row) {
                    return row.term+"/"+(row.year+543);
                },
                "generation": function(column, row) {
                    if (row.generation == 0)
                        return 'ทุกรุ่น';
                    
                    return row.generation;
                },
                "section": function(column, row) {
                    if (row.section == 0)
                        return 'ทุกตอนเรียน';
                    
                    return row.section.toUpperCase();
                },
                "commands": function(column, row) {
                    return '<form action="{{ url('member/activities') }}/' + row.id +'" method="POST">{{ csrf_field() }}{{ method_field('DELETE') }}<a href="{{ url('/member/activities') }}/' + row.id +'/edit" class="btn btn-xs btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a><button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></form>';
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
            <h3>กิจกรรม</h3>
        </div>
    </div>
    <table id="table-activity" class="table table-condensed table-hover table-striped">
    	<thead>
            <tr>
                <th data-column-id="id" data-type="numeric" data-width="75px">#</th>
                <th data-column-id="name">ชื่อกิจกรรม</th>
                <th data-formatter="event" data-width="110px">วันที่จัด</th>
                <th data-formatter="term-year" data-width="90px">เทอม/ปี</th>
                <th data-column-id="category">ประเภท</th>
                <th data-formatter="generation" data-width="100px">รุ่น</th>
                <th data-formatter="section" data-width="100px">ตอนเรียน</th>
                <th data-formatter="commands" data-sortable="false" data-width="75px">&nbsp;</th>
            </tr>
        </thead>
    </table>
@endsection