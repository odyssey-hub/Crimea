<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function add(Request $request)
    {
          $route = new Route();
          $route->name = $request->input("name");
          $route->description = $request->input("description");
          $route->duration = $request->input("duration");
          $route->cost = $request->input("cost");
          $route->attractions = $request->input("attractions");
          $route->gid = $request->input("gid");
          $route->points = json_encode([]);
          $route->save();

          return $route->id;
    }

    public function editInfo(Request $request)
    {
        $id = $request->input('id');
        $route = Route::find($id);
        $route->name = $request->input("name");
        $route->description = $request->input("description");
        $route->duration = $request->input("duration");
        $route->cost = $request->input("cost");
        $route->attractions = $request->input("attractions");
        $route->gid = $request->input("gid");
        $route->save();
    }

    public function savePath(Request $request)
    {
        $id = $request->input('id');
        $route = Route::find($id);
        $route->points = $request->input('points');
        $route->save();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $route = Route::find($id);
        $route->delete();
    }


    public function getData(Request $request)
    {
        $id = $request->input('id');
        $route = Route::find($id);
        $result = array(
            'name'  =>  $route->name,
            'description' =>  $route->description,
            'duration' => $route->duration,
            'cost' => $route->cost,
            'attractions' =>  $route->attractions,
            'gid' => $route->gid
        );
        return json_encode($result);
    }

    public function getPath(Request $request)
    {
        $id = $request->input('id');
        $route = Route::find($id);
        return $route->points;
    }
}
