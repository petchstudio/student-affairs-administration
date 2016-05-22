<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Activities;
use App\Bootgrid;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.activities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activities = Activities::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'term' => $request->input('term'),
            'year' => $request->input('year'),
            'generation' => $request->input('generation'),
            'section' => $request->input('section'),
            'event_at' => Carbon::createFromFormat('d/m/Y', $request->input('event-start')),
        ]);


        if (is_null($activities))
        {
            return back()->withInput()
                    ->with([
                        'status' => 'fail',
                        'class' => 'danger',
                        'icon' => 'warning',
                        'message' => 'ไม่สามารถเพิ่มข้อมูลได้',
                    ]);
        }

        return redirect('/member/activities')->withInput()
                ->with([
                    'status' => 'success',
                    'class' => 'success',
                    'icon' => 'checkmark-circle',
                    'message' => 'เพิ่มกิจกรรมสำเร็จ',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activities = Activities::find($id);

        return view('member.activities.edit', [
            'activities' => $activities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $activities = Activities::find($id);

        $activities->name = $request->input('name');
        $activities->description = $request->input('description');
        $activities->category_id = $request->input('category');
        $activities->term = $request->input('term');
        $activities->year = $request->input('year');
        $activities->generation = $request->input('generation');
        $activities->section = $request->input('section');
        $activities->event_at = Carbon::createFromFormat('d/m/Y', $request->input('event-start'));

        if ($activities->save())
        {
            return redirect('/member/activities')
                    ->with([
                        'status' => 'success',
                        'class' => 'success',
                        'icon' => 'checkmark-circle',
                        'message' => 'แก้ไขข้อมูลสำเร็จ',
                    ]);
        }

        return back()->withInput()
                    ->with([
                        'status' => 'fail',
                        'class' => 'danger',
                        'icon' => 'warning',
                        'message' => 'ไม่สามารถแก้ไขข้อมูลได้',
                    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activities = Activities::find($id)->delete();

        if (is_null($activities))
        {
            return back()->with([
                        'status' => 'fail',
                        'class' => 'danger',
                        'icon' => 'warning',
                        'message' => 'ไม่สามารถลบข้อมูลได้',
                    ]);
        }

            return back()->with([
                    'status' => 'success',
                    'class' => 'success',
                    'icon' => 'checkmark-circle',
                    'message' => 'ลบกิจกรรมสำเร็จ',
                ]);
    }

    public function showIndexJson(Request $request)
    {
        $bootgrid = new Bootgrid($request);

        $connection = Activities::leftJoin('activities_category', 'activities.category_id', '=', 'activities_category.id')
                    ->select(
                        'activities.*',
                        'activities_category.name as category'
                    );

        if( $bootgrid->hasSearch() )
        {
            $connection = $connection->Where(function($query) use ($bootgrid)
            {
                $query
                    ->where('name', 'LIKE', '%'.$bootgrid->getKeyword().'%')
                    ->orWhere('description', 'LIKE', '%'.$bootgrid->getKeyword().'%');
            });
        }

        $bootgrid->setConnection($connection);

        $bootgrid->setSort(['updated_at'=>'desc']);

        return response()->json($bootgrid->get());
    }
}
