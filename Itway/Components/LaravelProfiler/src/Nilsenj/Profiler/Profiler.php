<?php namespace Nilsenj\Profiler;

use Exception;
use Session;
use Request;
use Config;
use Cookie;
use Route;
use Input;
use View;
use Auth;

/**
 * Class Profiler
 * @package Nilsenj\Profiler
 */
class Profiler {

    public function start()
    {

        if (!config('profiler.enabled')){
            return false;
        }
        else{
            Session::flash('nilsenj.profiler.start', $this->getTime());

        }
    }

    public function handle($data)
    {

        if (!config('profiler.enabled')){
            return false;
        }
        else{
            Session::flash(
                    'nilsenj.profiler.data',
                    (object) [
                        'project_code'  => config('profiler.project_code'),
                        'url'           => Request::path(),
                        'method'        => Request::method(),
                        'controller'    => get_class($data),
                        'route'         => Route::currentRouteName(),
                        'user_id'       => isset(Auth::user()->id) ? Auth::user()->id : null,
                        'agent'         => isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : null,
                        'referer'       => isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null,
                        'cookie'        => Cookie::get(config('session.cookie')),
                        'request_body'  => $this->isHasSecretContent(Request::instance()->getContent(), Request::path()),
                        'request_data'  => (Input::all()) ? $this->isHasSecretContent(json_encode(Input::all()), Request::path()) : null,
                        'ip_address'    => Request::getClientIp(),
                    ]
                );
        }
    }

    public function stop()
    {

            $this->data = Session::get('nilsenj.profiler.data');

            if ($this->data === null) return false;

            $this->data->response_time = number_format($this->getTime() - Session::get('nilsenj.profiler.start'), 4);

            $this->data->memory_usage  = memory_get_usage();

            $this->saveProfilerData();

    }

    public function readableSizeFormat($size)
    {
        if ($size < 1024){
            return $size.' B';
        }

        if ($size < 1048576){
            return sprintf("%4.2f KB", $size/1024);
        }

        if ($size < 1073741824){
            return sprintf("%4.2f MB", $size/1048576);
        }

        if ($size < 1099511627776){
            return sprintf("%4.2f GB", $size/1073741824);
        }
        else{
            return sprintf("%4.2f TB", $size/1073741824);
        }
    }

    private function saveProfilerData()
    {
        $model = new ProfilerModel;
        try{
            foreach ($this->data as $key => $value) {
                $model->{$key} = $value;
            }

            foreach (config('profiler.excluded_url') as $key => $value) {
                if (str_is($value, $model->url) !== false){
                    return;
                }
            }

            $model->save();
        }
        catch(Exception $e){
            return;
        }
    }

    private function isHasSecretContent($text, $url)
    {
        try{
            foreach (config('profiler.has_secret_content_url') as $key => $value) {
                if (str_is($value, $url) !== false){
                    return "secret content";
                }
            }
            return $text;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    private function getTime()
    {
        $time = explode(" ", microtime());
        return $time[1] + $time[0];
    }

}