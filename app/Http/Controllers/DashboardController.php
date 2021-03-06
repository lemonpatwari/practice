<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            ['product_id' => 1, 'price' => 220, 'vat' => 5],
            ['product_id' => 2, 'price' => 200, 'vat' => 15],
            ['product_id' => 3, 'price' => 300, 'vat' => 40],
            ['product_id' => 4, 'price' => 305, 'vat' => 40],
            ['product_id' => 5, 'price' => 306, 'vat' => 40],
        ];

        $data = [
            'lemon@gmail.com', 'test@gmail.com'
        ];

        dump($data);
        dd(collect($data)->chunk(1));

        return collect($data)->min(function ($data) {
            return $data['price'] + $data['vat'];
        });
    }

    public function test()
    {
        $routes = \Route::getRoutes();

        $data = [];

        foreach ($routes as $key => $route) {

            $action_name = $route->getActionName();

            $passport_namespace = "\Laravel\Passport\Http\Controllers\\";
            $http_namespace = "App\Http\Controllers\\";


            /*if(\Str::contains($action_name, $passport_namespace)){
                $permission=\Str::snake(str_replace([$passport_namespace, '@', '\\'], ['', '_', ''], $action_name));
            }elseif(\Str::contains($action_name, $http_namespace)){
                $permission=\Str::snake(str_replace([$http_namespace,'@','\\'], ['', '_', ''], $action_name));
            }*/

            $permission = \Str::snake(str_replace([$passport_namespace, '@', '\\'], ['', '_', ''], $action_name));
            $permission = \Str::snake(str_replace([$http_namespace, '@', '\\'], ['', '_', ''], $action_name));

            $data[$key]['action_name'] = $action_name;
            $data[$key]['permission'] = $permission;
            $data[$key]['method_name'] = $permission;
            $data[$key]['route'] = $route->getName();
            $array = explode('.', $route->getName());
            $data[$key]['controller_name'] = $array[0] ?? null;
            $data[$key]['controller_method'] = $array[1] ?? null;

            $array = explode('.', $route->getName());
            $controller_name = $array[0] ?? null;
            $controller_method = $array[1] ?? null;

            if (empty($permission)) dd($action_name);

            if (\DB::table('route_permits')->where('permission', $permission)->exists()) continue;

            \DB::table('route_permits')->insert([
                'permission' => $permission,
                'action_name' => $action_name,
                'uri' => $route->uri(),
                'controller_name' => $controller_name,
                'controller_method' => $controller_method,
                'active' => FALSE
            ]);

            \DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'web'
            ]);

        }

        return 'working';
    }

    public function url()
    {

        $id = '%&^#@11884315411XY18843452aqz';

        $expd = explode('15411XY', $id);

        dump($expd);

        $id1 = intval(str_replace('%&^#@1', '', $expd[0]));
        $id2 = intval(str_replace('452aqz', '', $expd[1]));

        dump([$id1, '%&^#@1']);
        dump([$id2, '452aqz']);

        return 'ww';
    }

    public function emailStore(Request $request)
    {
        $providerArray = Provider::pluck('sender_email')->toArray();
        $providerCount = count($providerArray);
        $providerCounter = 0;

        $emailsArray = explode(',', $request->emails);

//        $content = $request->content;
        $content = '';
        $interval = $request->interval;
        $date = strtotime($request->dateTime);

        $emailsCounter = 0;

        foreach ($emailsArray as $email) {

            if ($providerCounter > $providerCount - 1) {
                $providerCounter = 0;
            }

            $delayTime = $date + ($interval * $emailsCounter);

            /*$job = (new SendUpComingStudentEmail($providerArray[$providerCounter], trim($email), $content, '1'))
                ->onQueue('campaign')
                ->delay($delayTime - time());
            $this->dispatch($job);*/

            Artisan::call('config:clear');
            Artisan::call('config:cache');

            $configuration = Provider::where("sender_email", $providerArray[$providerCounter])->first();
            if (!is_null($configuration)) {
                $config = array(
                    'driver' => $configuration->driver,
                    'host' => $configuration->host,
                    'port' => $configuration->port,
                    'username' => $configuration->sender_name,
                    'password' => $configuration->password,
                    'encryption' => $configuration->encryption,
                    'from' => array('address' => $configuration->sender_email, 'name' => 'DIU'),
                );
                Config::set('mail', $config);
            }

            \Mail::to(trim($email))->send(
                new SendEmail($content, 'test', $providerArray[$providerCounter])
            );

            $providerCounter++;
            $emailsCounter++;

        }

        return [$providerArray, $providerCount, $providerCounter, $emailsArray];
    }


    public function test2()
    {

        $fp = fsockopen("172.16.7.88", 6722, $errno, $errstr, 30);

        $opts = array(
            "start_1" => "11",
            "stop_1" => "21",

            "start_2" => "12",
            "stop_2" => "22",

            "start_3" => "13",
            "stop_3" => "23",
        );


        fwrite($fp, "00");
        $curstate = fread($fp, 2);


        switch ($curstate) {
            case '01':
                $td1st = "btn-danger";
                $td2st = "btn-success";
                $td3st = "btn-danger";
                $button1action = "start_1";
                $button2action = "stop_2";
                $button3action = "stop_3";
                break;
            case '10':
                $td1st = "btn-success";
                $td2st = "btn-danger";
                $td3st = "btn-danger";
                $button1action = "stop_1";
                $button2action = "start_2";
                $button3action = "stop_3";
                break;
            case '11':
                $td1st = "btn-success";
                $td2st = "btn-success";
                $td3st = "btn-success";
                $button1action = "stop_1";
                $button2action = "stop_2";
                $button3action = "stop_3";
                break;
            default:
                $td1st = "btn-danger";
                $td2st = "btn-danger";
                $td3st = "btn-danger";
                $button1action = "start_1";
                $button2action = "start_2";
                $button3action = "start_3";
                break;
        }

        return view('test2', compact(
            'button1action',
            'button2action',
            'button3action',
            'td1st',
            'td2st',
//            'td3st'
        ));
    }

    public function lmn(Request $request)
    {
        $fp = fsockopen("172.16.7.88", 6722, $errno, $errstr, 30);

        $opts = array(
            "start_1" => "11",
            "stop_1" => "21",

            "start_2" => "12",
            "stop_2" => "22",

        );


        $act = $request->action;
        fwrite($fp, $opts[$act]);

//        fwrite($fp, 11);

        dump(fwrite($fp, $opts[$act]));


        fwrite($fp, "00");

        $curstate = fread($fp, 2);

        dump($curstate);

        switch ($curstate) {
            case '01':
                $td1st = "btn-danger";
                $td2st = "btn-success";
//                $td3st = "btn-danger";
                $button1action = "start_1";
                $button2action = "stop_2";
//                $button3action = "stop_3";
                break;
            case '10':
                $td1st = "btn-success";
                $td2st = "btn-danger";
//                $td3st = "btn-danger";
                $button1action = "stop_1";
                $button2action = "start_2";
//                $button3action = "stop_3";
                break;
            case '11':
                $td1st = "btn-success";
                $td2st = "btn-success";
//                $td3st = "btn-success";
                $button1action = "stop_1";
                $button2action = "stop_2";
//                $button3action = "stop_3";
                break;
            default:
                $td1st = "btn-danger";
                $td2st = "btn-danger";
//                $td3st = "btn-danger";
                $button1action = "start_1";
                $button2action = "start_2";
//                $button3action = "start_3";
                break;
        }

        return view('test2', compact(
            'button1action',
            'button2action',
//            'button3action',
            'td1st',
            'td2st',
//            'td3st'
        ));
    }
}
