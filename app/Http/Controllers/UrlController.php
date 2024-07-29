<?php

namespace App\Http\Controllers;

use App\Click;
use App\Http\StCommands\UrlShortCommand;
use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Session;

class UrlController extends Controller
{
    public function index(Request $request)
    {
        /* $request->session()->flash('notice', 'Task was successful!'); */

        $url = new Url;

        $urls = Url::all();
        return view('user.index', ['url' =>$url, 'urls' => $urls]);
    }

    public function create(Request $request)
    {
        $original_url = $request->original_url;
        $url = new Url();

        $foundUrl = Url::where('original_url', $original_url)->first();
        $shortCommand = new UrlShortCommand();
        $short_url = $shortCommand->withData($original_url)->execute();

        if(!isset($foundUrl) && $short_url){
            // Session::flash('notice', 'Duplicated url');
            $url->original_url = $original_url;
            $url->short_url = $short_url;
            $url->clicks_count = 0;

            $url->save();
            Session::flash('notice', 'Saved url with success!');

            $urls = Url::all();
            return view('user.index', ['url' =>$url, 'urls' => $urls]);
        }else{
            Session::flash('notice', 'Duplicated url');
            $urls = Url::all();
            return view('user.index', ['url' =>$url, 'urls' => $urls]);
        }
    }

    public function visit($url)
    {
        // dd($url);
        $urlObj = Url::where('short_url', $url)->first();
        $urlObj->clicks_count += 1;
        $urlObj->save();
        
        $click = new Click();

        $agent = new Agent();
        
        $click->platform = $agent->platform();
        $click->browser = $agent->browser();
        $click->url_id = $urlObj->id;

        $click->save();

        $urls = Url::all();
        return view('user.index', ['url' =>$url, 'urls' => $urls]);
        // $url = find record a clicks, update irl clicks count and redirect to original url
    }


    public function show(Request $request)
    {
        $short_url = $request->query('short_url');

        $url = Url::where('short_url', $short_url)->first();

        $daily_clicks = Click::where('url_id', $url->id)
                        ->groupBy('day')
                        ->orderBy('day', 'DESC')
                        ->get([
                            DB::raw('DAY(created_at) as day'),
                            DB::raw('COUNT(*) as clicks')
                        ]);
        
        $clicks = [];
        $key = 0;
        foreach($daily_clicks as $el){
            $clicks[$key++] = [strval($el->day), intval($el->clicks)];
        }

        $browser_clicks = Click::where('url_id', $url->id)
                        ->groupBy('browser')
                        ->get([
                            DB::raw('browser'),
                            DB::raw('COUNT(*) as clicks')
                        ]);
        
        $browser = [];
        $key = 0;
        foreach($browser_clicks as $el){
            $browser[$key++] = [strval($el->browser), intval($el->clicks)];
        }

        // dd($browser);

        $platform_clicks = Click::where('url_id', $url->id)
                        ->groupBy('platform')
                        ->get([
                            DB::raw('platform'),
                            DB::raw('COUNT(*) as clicks')
                        ]);
        
        $platform = [];
        $key = 0;
        foreach($platform_clicks as $el){
            $platform[$key++] = [strval($el->platform), intval($el->clicks)];
        }

        // dd($platform);

        return view('user.show', ['url' =>$url, 'browsers_clicks' => $browser, 'daily_clicks' => $clicks, 'platform_clicks' => $platform]);
    }

    public function previousTen()
    {
        $url = Url::select()->orderBy('created_at','DESC')->take(10)->get();
        return response()->json([
            'data' => $url
        ]);
    }
}
