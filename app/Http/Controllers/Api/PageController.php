<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{

    //creare la PageController con "php artisan make:controller Api/PageController" che è il file di controllo delle nostre rotte delle API creat attraverso laravel e MySQL

    public function index(){
        $projects = Project::with('technologies','type')->paginate(10);

        foreach($projects as $project){
            if($project->image){
                //se è presente l'immagine con il etodo asset ricavo l'url assoluto
                $project->image = asset('storage/'.$project->image);
            }else{
                //se l'immagine non è presente restiutisce il placeholder cioè l'immagine vuota
                $project->image = asset('storage/uploads/placeholder.png');
            }
        }

        return response()->json($projects);
    }

    public function getProjectBySlug($slug){
        //query che mi prende il project con lo slug passato
        $project = Project::where('slug',$slug)->with('technologies','type')->first();

        if($project) $success = true;
        else $success = false;

        if($project->image){
            //se è presente l'immagine con il etodo asset ricavo l'url assoluto
            $project->image = asset('storage/'.$project->image);
        }else{
            //se l'immagine non è presente restiutisce il placeholder cioè l'immagine vuota
            $project->image = asset('storage/uploads/placeholder.png');
        }

        return response()->json(compact('project','success'));
    }

}
