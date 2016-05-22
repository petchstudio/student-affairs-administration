<?php

namespace App\Http\Controllers;

use App\User;
use App\Bootgrid;
use App\ActivitiesJoin;
use App\Http\Requests;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
    	return view('parent');
    }

    public function search(Request $request)
    {
    	$student = User::where('sdu_id', $request->input('q'))->first();
    	$activities = ActivitiesJoin::where('student_id', $student->id)
	    				->join('activities', 'activities_join.activities_id', '=', 'activities.id')
	    				->leftJoin('activities_category', 'activities.category_id', '=', 'activities_category.id')
	                    ->select(
	                        'activities.*',
	                        'activities_category.name as category'
	                    )
	                    ->get();

    	return view('parent', [
    		'student' => $student,
    	]);
    }


    public function showSearchJson(Request $request)
    {
        $bootgrid = new Bootgrid($request);

    	$connection = ActivitiesJoin::where('student_id', $request->input('id'))
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
                    ->where('activities.name', 'LIKE', '%'.$bootgrid->getKeyword().'%')
                    ->orWhere('activities.description', 'LIKE', '%'.$bootgrid->getKeyword().'%');
            });
        }

        $bootgrid->setConnection($connection);

        $bootgrid->setSort(['id'=>'desc']);

        return response()->json($bootgrid->get());
    }}
