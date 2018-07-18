<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branches;
use App\BranchesPhones;

class BranchesController extends Controller
{
    //
    public function __construct()
    {
        $this->branches = new Branches();
        $this->branches_phone = new BranchesPhones();
    }

    public function BranchesIndex()
    {
        return view('branches.branches');
    }

    public function GetAllBraches()
    {
        return $this->branches->with('BranchesPhone')->get();
    }

    public function StoreBranches()
    {
        $input = Request()->all();
        $branches = $this->branches->create($input);
        $branches_id = $branches->branches_id;
        for ($i = 0; $i < sizeof($input['brances_phone']); $i++) {

            $input['branches_phone'][$i]['branches_id'] = $branches_id;
            $this->branches_phone->create($input['brances_phone'][$i]);
        }

        return $this->branches->with('BranchesPhone')->where('branches_id', $branches)->get();
    }

    public function UpdateBranches($id)
    {
        $input = Request()->all();
        $branches = $this->branches->find($id)->update($input);
        for ($i = 0; $i < sizeof($input['branches_phone']); $i++) {
//return $input['branches_phone'][$i]['branches_phones_id'];
            $this->branches_phone
                ->find($input['branches_phone'][$i]['branches_phones_id'])
                ->update($input['branches_phone'][$i]);
        }

        return 'true';

    }

    public function DeleteBranches($id)
    {
        $this->branches->find($id)->delete();
        $this->branches_phone->where('branches_id', $id)->delete();
        return 'true';

    }

    public function DeleteBranchPhone($id)
    {
        $this->branches_phone->find($id)->delete();
        return 'true';

    }
}
