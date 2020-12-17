<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use  App\Http\Resources\ProjectResource;
use App\Models\Images;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Project = Project::paginate();
        return  ProjectResource::collection($Project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $file[] = $request->file('images'); 
     
  
        foreach ( $request->file('images') as $file) {
            $postImage = new Images;
            $name = Str::random(10);
            $url =  \Storage::putFileAs('images',$file,$name . '.' . $file->extension());
            $postImage->project_id = $request->project_id;
            $postImage->url = $url;
            $postImage->save();
        }
      
        $Project = Project::create([
            'project_id' => $request->project_id,
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
           
        ]);
      
        
      

        return response($Project,  Response::HTTP_CREATED);

      //  $Project = Project::create($request->only('project_id','project_name','images','project_description'));
      //  return response($Project,  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Project = Project::find($id);
        $Project->Project($request->all());
            return response( new ProjectResource($Project), 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Project = Project::destroy($id);
        return response(new ProjectResource($Project), 204);
    }
}
