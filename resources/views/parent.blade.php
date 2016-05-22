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
            post: function ()
            {
                return {
                    id: "{{ Request::isMethod('post') ? $student->id:0 }}",
                };
            },
            url: "{!! url('/api/parent/search') !!}",
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
                "status": function(column, row) {
                    return row.status_join == 1 ? 'เข้าร่วม':'-';
                }
            },
        });
    });
    </script>
@stop

@section('content-panel')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">บริการผู้ปกครอง</h3>
        </div>
        <div class="panel-body">
            <form action="{{ url('/parent') }}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}

                <div>
                    <label for="input-q" class="col-xs-3 col-sm-2 col-sm-offset-2 control-label">รหัสนักศึกษา</label>
                    <div class="col-xs-10 col-sm-4">
                        <input type="text" class="form-control" id="input-q" name="q" placeholder="Ex. {{ date('y')+43 }}110119400123" value="{{ Request::input('q') }}">

                        @if ($errors->has('q'))
                            <span class="help-block">
                                <strong>{{ $errors->first('q') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-2 col-sm-2">
                        <button class="btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
        @if (Request::isMethod('post'))
            <hr>
            <div class="panel-body">
                
                @if (is_null($student))
                    <h3>ไม่พบข้อมูล</h3>
                @else
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4 col-sm-2 col-sm-offset-5">
                            <img src="{{ asset($student->avatar) }}" class="img-responsive">
                        </div>
                    </div>
                    <div class="text-center m-t-30">
                        {{ $student->firstname }}
                        {{ $student->lastname }}
                    </div>
                    <div class="text-center m-b-30">
                        ตอนเรียน {{ strtoupper($student->section) }}
                    </div>
                    <table id="table-activitiest" class="table">
                        <thead>
                            <tr>
                                <th data-formatter="name">ชื่อกิจกรรม</th>
                                <th data-formatter="event" data-width="110px">วันที่จัด</th>
                                <th data-formatter="term-year" data-width="90px">เทอม/ปีการศึกษา</th>
                                <th data-column-id="category">ประเภท</th>
                                <th data-formatter="status" data-width="100px">การเข้าร่วม</th>
                            </tr>
                        </thead>
                    </table>
                @endif
            </div>
        @endif
    </div>
@stop