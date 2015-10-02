<?php namespace Nilsenj\Profiler;

use Illuminate\Routing\Controller as BaseController;
use Exception;
use DB;
use Nilsenj\Profiler\ProfilerModel;

class ProfilerController extends BaseController {


	public function getList()
	{

        try{
            $data['data']           = ProfilerModel::orderBy('id', 'desc')->paginate(30);
            $data['total']          = ProfilerModel::count();
            $data['response_time']  = ProfilerModel::select(DB::raw('avg(response_time) as time'))->first();
            $data['memory_usage']   = ProfilerModel::select(DB::raw('avg(memory_usage) as memory'))->first();

            return view('profiler::list', $data);
        }
        catch(Exception $e){

            die("Error : ".$e->getMessage());

        }
	}
}