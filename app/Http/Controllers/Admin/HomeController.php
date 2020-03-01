<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Visitor;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;

        
        $acessos = intval($request->input('periodo', 30));
        if($acessos > 120){
            $acessos = 120;
        }
        
    //Contagem de Visitantes
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$acessos.'days'));
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();

        //Contagem de Usuários Online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        //Contagem de Páginas
        $pageCount = Page::count();

        //Contagem de Usuários
        $userCount = User::count();

        //Contagem para o PagePie
        $pagePie = [];
        $datelimit2 = date('Y-m-d H:i:s', strtotime('-30 days'));
        $visitsAll = Visitor::selectRaw('page, count(page) as c')
        ->where('date_access', '>=', $dateInterval)
        ->groupBy('page')
        ->get();        
        
        foreach($visitsAll as $visit){
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'acessos' => $acessos,
            'dateInterval' => $dateInterval,
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues
        ]);
    }

    public function acessos(Request $request){

        $acessos = intval($request->input('periodo', 30));
        if($acessos > 120){
            $acessos = 120;
        }
        
    //Contagem de Visitantes
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$acessos.'days'));
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();
        
        return view('admin.home', [
            'visitsCount' => $visitsCount
        ]);
    }
}
