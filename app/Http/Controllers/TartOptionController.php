<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TartOption;
use App\TartSize;
use App\TartFloors;
use App\Items;

class TartOptionController extends Controller
{
    //

    public function __construct()
    {
        $this->tart_option = new TartOption();
        $this->tart_size = new TartSize();
        $this->tart_floors = new TartFloors();
        $this->items = new Items();

    }

    public function TartOptions()
    {
        return view('tartoptions.tartoptions');
    }

    public function GetTartOptions()
    {
        return $this->tart_option
            ->leftjoin($this->items->getTable(), $this->tart_option->getTable() . '.item_id', $this->items->getTable() . '.item_id')
            ->leftjoin($this->tart_size->getTable(), $this->tart_option->getTable() . '.size_id', $this->tart_size->getTable() . '.size_id')
            ->leftjoin($this->tart_floors->getTable(), $this->tart_option->getTable() . '.floors_id', '=', $this->tart_floors->getTable() . '.floors_id')
            ->get();
    }

    public function CreateNewTartOptions()
    {
        $input = Request()->all();
        $output = $this->tart_option->create($input);
        return $this->tart_option
            ->leftjoin($this->items->getTable(), $this->tart_option->getTable() . '.item_id', $this->items->getTable() . '.item_id')
            ->leftjoin($this->tart_size->getTable(), $this->tart_option->getTable() . '.size_id', $this->tart_size->getTable() . '.size_id')
            ->leftjoin($this->tart_floors->getTable(), $this->tart_option->getTable() . '.floors_id', '=', $this->tart_floors->getTable() . '.floors_id')
            ->where($this->tart_option->getTable() . '.tart_option_id', $output->tart_option_id)
            ->get();
    }


    public function UpdateTartOptions($id)
    {
        $input = Request()->all();
        $output = $this->tart_option->find($id)->update($input);
        if ($output) {
            return 'true';
        } else {
            return 'false';
        }

    }

    public function deletetartOptions($id)
    {
        $output = $this->tart_option->find($id)->delete();
        if ($output) {
            return 'true';
        } else {
            return 'false';
        }

    }
}
