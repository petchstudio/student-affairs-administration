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
        var grid = $("#table-activitiest-join").bootgrid({
            ajax: true,
            ajaxSettings: {
                method: "GET",
            },
            url: "{!! url('/api/activities/'.$activities->id.'/join-list') !!}",
            selection: true,
            multiSelect: true,
            keepSelection: true,
            formatters: {
                "name": function(column, row) {
                    return row.firstname+' '+row.lastname;
                },
                "section": function(column, row) {
                    return row.section.toUpperCase();
                },
                "status": function(column, row) {
                    if(row.status_join == 1) {
                        //console.log(row);
                        $("#grid").bootgrid("select", [row.id]);
                        //
                    }
                    return row.status_join == 1 ? 'เข้าร่วม':'ไม่เข้าร่วม';
                },
            },
        }).on("loaded.rs.jquery.bootgrid", function(e) {
            var rows = grid.bootgrid("getCurrentRows");
            for (var i = 0; i < rows.length; i++) {
                if(rows[i].status_join == 1) {
                    grid.bootgrid("select", [rows[i].id]);
                }
                else {
                    grid.bootgrid("deselect", [rows[i].id]);
                }
           }
        }).on("selected.rs.jquery.bootgrid", function(e, rows) {
            for (var i = 0; i < rows.length; i++) {
                $.get('{!! url('/api/activities/join/') !!}/'+rows[i].id+'/selected', function(data) {
                    grid.bootgrid("reload");
                });
            }
            //alert("Select: " + rowIds.join(","));
        }).on("deselected.rs.jquery.bootgrid", function(e, rows) {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++) {
                $.get('{!! url('/api/activities/join/') !!}/'+rows[i].id+'/deselected', function(data) {
                    grid.bootgrid("reload");
                });
            }
        });
    });
    </script>
@stop

@section('content-panel')
    
    @include('includes.alert-response-session')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">กิจกรรม - {{ $activities->name }}</h3>
            <div class="pull-right">
                <a href="{{ url('/activities') }}">กลับไปหน้ากิจกรรม</a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
<?php
$evenDate = Carbon\Carbon::parse($activities->event_at);
?>
                <div class="col-xs-6 col-sm-4"><strong>ประเภท</strong> {{ App\ActivitiesCategory::getCategoryName($activities->category_id) }}</div>
                <div class="col-xs-6 col-sm-4"><strong>วันที่จัด</strong> {{ $evenDate->format('d-m') }}-{{ $evenDate->year+543 }}</div>
                <div class="col-xs-6 col-sm-4"><strong>เทอม/ปี</strong> {{ $activities->term }}/{{ $activities->year }}</div>
                <div class="col-xs-6 col-sm-4"><strong>รุ่น</strong> {{ strcmp($activities->generation, '0') == 0 ? 'ทุกรุ่น':$activities->generation }}</div>
                <div class="col-xs-6 col-sm-4"><strong>ตอนเรียน</strong> {{ strcmp($activities->section, '0') == 0 ? 'ทุกตอนเรียน':strtoupper($activities->section) }}</div>
            </div>
        </div>
        <hr>
        <div class="panel-body">
            {{ $activities->description }}
        </div>
        @if (Auth::check() && Auth::user()->type == 'student')
            <div class="panel-footer text-right">
                @if (App\Activities::canJoin($activities, Auth::user()))
                    <a href="{{ url('activities/'.$activities->id.'/join') }}" class="btn btn-primary">เข้าร่วมกิจกรรม</a>
                @else
                    <button type="button" class="btn btn-primary" disabled="disabled">กิจกรรมนี้ไม่สามารถเข้าร่วมได้</button>
                @endif
            </div>
        @endif
    </div>

    @if (Auth::check() && Auth::user()->type == 'teacher')
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">นักศึกษาที่ลงชื่อเข้าร่วมกิจกรรม</h3>
            </div>
            <div class="panel-body">
                <table id="table-activitiest-join" class="table">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true" data-visible="false" data-visibleInSelection="false">ID</th>
                            <th data-column-id="sdu_id" data-width="140px">รหัสนักศึกษา</th>
                            <th data-column-id="name" data-formatter="name">ชื่อ นามสกุล</th>
                            <th data-column-id="section" data-formatter="section" data-width="90px">ตอนเรียน</th>
                            <th data-column-id="status" data-formatter="status" data-width="100px">การเข้าร่วม</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endif
@stop