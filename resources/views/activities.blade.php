@extends('layouts.front-office')

@section('link')
    @parent
    <link href="{{ asset('assets/js/plugins/jquery.bootgrid/1.3.1/jquery.bootgrid.min.css') }}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{{ asset('assets/js/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.bootgrid/1.3.1/jquery.bootgrid.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var grid = $("#table-activitiest").bootgrid({
            ajax: true,
            ajaxSettings: {
                method: "GET",
            },
            url: "{!! url('/api/activities') !!}",
            formatters: {
                "name": function(column, row) {
                    return '<a href="{{ url('/activities') }}/'+row.id+'">'+row.name+'</a>';
                },
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
                }
            },
        });
    });
    </script>
@stop

@section('content-panel')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">กิจกรรม</h3>
        </div>
        <div class="panel-body">
            <table id="table-activitiest" class="table">
                <thead>
                    <tr>
                        <th data-formatter="name">ชื่อกิจกรรม</th>
                        <th data-formatter="event" data-width="110px">วันที่จัด</th>
                        <th data-formatter="term-year" data-width="90px">เทอม/ปี</th>
                        <th data-column-id="category">ประเภท</th>
                        <th data-formatter="generation" data-width="50px">รุ่น</th>
                        <th data-formatter="section" data-width="90px">ตอนเรียน</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop