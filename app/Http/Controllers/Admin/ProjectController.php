<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpsertRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
/* use Log; */

class ProjectController extends Controller{
  protected function generateSlug($data, $title){
    // Counter to start from a number
    $counter = 0;

    // I establish a do-while cycle
    do {
      // $slug will be the title of the stored Project + "-<counter-number>" if the counter is higher than zero, otherwise ""
      $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");
      // it if there is a slug in DB called the same way than the just created slug
      $alreadyExists = Project::where("slug", $slug)->first();
      // increase the counter
      $counter++;
    } while ($alreadyExists);

    /* if($alreadyExists){
        $data["slug"] = $data["slug"] . "";
        return redirect()->route("admin.projects.create")->with("message", "This project's title already exists!");
    } */

    //once the do-while cycle stopped because there where no other slug called the same way I establish the last made slug as the new Project's slug
    return $slug;
  }


  public function index(){
    $projects = Project::all();
    return view("admin.projects.index", compact("projects"));
  }
  

  public function show($slug){
    $project = Project::where("slug", $slug)->first();
    return view("admin.projects.show", compact("project"));
  }


  public function create(){
    $types = Type::all(); 
    // with compact I can pass an argument (being an array, a variable, etc) to a view
    return view("admin.projects.create", compact("types"));
  }


  // store will be an instance of ProjectUpsertRequest
  public function store(ProjectUpsertRequest $request){

    /* Log::debug('TESTO');
    die(); */

    // validateD refers to ProjectUpsertRequest file to know which params store
    $data = $request->validated();

    $data["slug"] = $this->generateSlug($data, $data["title"]);
    
    /* new Project();
    $project->fill($data)
    $project->save(); */

    if (isset($data["thumb_link"])) {
      // I get the binary code of the linked image
      $imgLink = file_get_contents($data["thumb_link"]);

      // I create a name for the image via a unique path
      $path = "projects/" . uniqid();

      // I create the file using the binary code as its content
      File::put(storage_path("/app/public/" . $path), $imgLink);

      // I save path in db
      $data["thumb"] = $path;

    } else if (isset($data["thumb"])){
      // I save the file in filesystem
      $data["thumb"] = Storage::put("projects", $data["thumb"]);
    }

    $project = Project::create($data);

    // return the show route with the id as the new project's id
    return redirect()->route("admin.projects.show", $project->slug);
  }


  public function edit($slug){
    $project = Project::where("slug", $slug)->firstOrFail();
    $types = Type::all();
    return view("admin.projects.edit", compact("project", "types"));
  }


  public function update(ProjectUpsertRequest $request, $slug){
    $data = $request->validated();
    
    $project = Project::where("slug", $slug)->firstOrFail();
    
    if ($data["title"] !== $project->title){
      $data["slug"] = $this->generateSlug($data, $data["title"]);
    }

    // If I set the image as a link, opposed of loading the image via the input type file I set the image as
    // a string in thumb_link instead of simple thumb
    if (isset($data["thumb_link"])) {
      if($project->thumb){
        Storage::delete($project->thumb);
        /* File::delete($project->thumb); */
      }
      // I get the binary code of the linked image
      $imgLink = file_get_contents($data["thumb_link"]);

      // I create a name for the image via a unique path
      $path = "projects/" . uniqid();

      // I create the file using the binary code as its content
      File::put(storage_path("app/public/" . $path), $imgLink);

      // I save path in db
      $data["thumb"] = $path;

    } else if (isset($data["thumb"])){
      // If an image already exists I delete it
      if ($project->thumb){
        File::delete($project->thumb);
        Storage::delete($project->thumb);
      }

      // I save the file in filesystem
      $data["thumb"] = Storage::put("projects", $data["thumb"]);
    }

    $project->update($data);

    return redirect()->route("admin.projects.show", $project->slug);
  }


  public function destroy($slug){
    $project = Project::where("slug", $slug)->firstOrFail();
    $project->delete();
    Storage::delete($project->thumb);
    return redirect()->route("admin.projects.index");
  }
}
