<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    
    public function showHome()
    {
    	return redirect('/member/activities');// view('member.home');
    }
}
