<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\ActivitiesCategory;
use App\Bootgrid;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivitiesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.activities-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.activities-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activities = ActivitiesCategory::create([
            'name' => $request->input('name'),
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

        return redirect('/member/activities-category')->withInput()
                ->with([
                    'status' => 'success',
                    'class' => 'success',
                    'icon' => 'checkmark-circle',
                    'message' => 'เพิ่มประเภทกิจกรรมสำเร็จ',
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
        $activities = ActivitiesCategory::find($id);

        return view('member.activities-category.edit', [
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
        $activities = ActivitiesCategory::find($id);

        $activities->name = $request->input('name');

        if ($activities->save())
        {
            return back()->withInput()
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
        $activities = ActivitiesCategory::find($id)->delete();

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
                    'message' => 'ลบประเภทกิจกรรมสำเร็จ',
                ]);
    }

    public function showIndexJson(Request $request)
    {
        $bootgrid = new Bootgrid($request);

        $connection = new ActivitiesCategory();

        if( $bootgrid->hasSearch() )
        {
            $connection = $connection->Where(function($query) use ($bootgrid)
            {
                $query
                    ->where('name', 'LIKE', '%'.$bootgrid->getKeyword().'%');
            });
        }

        $bootgrid->setConnection($connection);

        $bootgrid->setSort(['updated_at'=>'desc']);

        return response()->json($bootgrid->get());
    }
}
