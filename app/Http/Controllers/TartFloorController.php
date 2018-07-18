<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TartFloors;
class TartFloorController extends Controller
{
    //
    public function __construct()
    {
        $this->tart_floor = new TartFloors();
    }

    public function TartFloorIndex()
    {
        return view('tartfloor.tartfloor');
    }
    public  function GetAllTartFloor(){
        return $this->tart_floor->all();
    }

    public function CreateNewTartFloor()
    {
        $input = Request()->all();
        return $this->tart_floor->create($input);
    }

    public function updateTartFloor($id)
    {
        $input = Request()->all();
        $this->tart_floor->find($id)->update($input);
        return 'true';
    }

    public function DeleteTurtFloor($id)
    {
        $this->tart_floor->find($id)->delete();
        return 'true';
    }
}
