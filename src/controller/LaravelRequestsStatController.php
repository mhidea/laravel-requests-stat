<?php

namespace Mhidea\LaravelRequestsStat\controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mhidea\LaravelRequestsStat\MhRequestsStat;

class LaravelRequestsStatController extends Controller
{

    /**
     * LaravelRequestsStat Home page
     *
     * You can view all routes and test them quickly.
     *
     * @return view
     **/
    public function index()
    {

        return view("LaravelRequestsStat::index", ['stats' => MhRequestsStat::all()]);
    }

    /**
     * Reset path's stats
     *
     * Sets count and sum to zero, timestaps from now.
     *
     * @param  \Illuminate\Http\Request  $request
     
     * @return view
     **/
    public function reset(Request $request, $id)
    {

        $stat = MhRequestsStat::where('id', $id)->update([
            'count' => 0,
            'sum' => 0,
            'created_at' => now()
        ]);
        return redirect()->route('laravelRequestsStat.index');
    }

    /**
     * Reset all paths' stats
     *
     * Sets count and sum to zero, timestaps from now.
     *
     * @return type
     * @throws conditon
     **/
    public function resetall()
    {
        $n = now();
        MhRequestsStat::where('count', '>', 0)->update([
            'count' => 0,
            'sum' => 0,
            'created_at' => $n
        ]);
        return true;
    }
}
