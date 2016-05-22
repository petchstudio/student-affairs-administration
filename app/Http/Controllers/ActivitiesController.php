<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Bootgrid;
use App\Activities;
use App\ActivitiesJoin;
use App\Http\Requests;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities = Activities::find($id);

        return view('activities-show', ['activities' => $activities]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJoin()
    {
        return view('activities-join');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, $id)
    {
        if (Auth::guest())
            abort(404);

        $activities = Activities::findOrFail($id);
        $student_id = Auth::user()->getKey();
        
        if (ActivitiesJoin::where('student_id', $student_id)->where('activities_id', $activities->id)->count() > 0)
            return back()->withInput()
                    ->with([
                        'status' => 'fail',
                        'class' => 'danger',
                        'icon' => 'warning',
                        'message' => 'กิจกรรมนี้ได้เข้าร่วมแล้ว',
                    ]);
        
        $activitiesJoin = ActivitiesJoin::create([
            'student_id' => $student_id,
            'activities_id' => $activities->id,
            'status' => 0,
        ]);


        if (is_null($activitiesJoin))
        {
            return back()->with([
                        'status' => 'fail',
                        'class' => 'danger',
                        'icon' => 'warning',
                        'message' => 'ไม่สามารถเข้าร่วมกิจกรรมได้',
                    ]);
        }

        return back()->with([
                    'status' => 'success',
                    'class' => 'success',
                    'icon' => 'checkmark-circle',
                    'message' => 'เข้าร่วมกิจกรรมแล้ว',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveJoinStatus(Request $request, $id, $status)
    {
        $activitiesJoin = ActivitiesJoin::find($id);
        $activitiesJoin->status = $status == 'selected' ? 1:0;
        $activitiesJoin->save();
        
        return 'true';
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

    public function showJoinJson(Request $request)
    {
        $bootgrid = new Bootgrid($request);

        $connection = ActivitiesJoin::where('student_id', Auth::user()->getKey())
                        ->join('activities', 'activities_join.activities_id', '=', 'activities.id')
                        ->leftJoin('activities_category', 'activities.category_id', '=', 'activities_category.id')
                        ->select(
                            'activities.*',
                            'activities_join.status as status_join',
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

        $bootgrid->setSort(['activities_join.id'=>'desc']);

        return response()->json($bootgrid->get());
    }

    public function showJoinListJson(Request $request, $id)
    {
        $bootgrid = new Bootgrid($request);

        $connection = ActivitiesJoin::where('activities_id', $id)
                        ->join('users', 'activities_join.student_id', '=', 'users.id')
                        ->select(
                            'activities_join.id',
                            'activities_join.status as status_join',
                            'users.sdu_id',
                            'users.firstname',
                            'users.section',
                            'users.lastname'
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

        return response()->json($bootgrid->get());
    }
        
}
