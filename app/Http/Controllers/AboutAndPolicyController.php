<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutPolicy;

class AboutAndPolicyController extends Controller
{
    //
    public function __construct()
    {
        $this->about_policy = new AboutPolicy();
    }

    public function index()
    {
        return view('aboutpolicy.aboutpolicy');
    }

    public function GetAboutPolicy()
    {

        return $this->about_policy->all();
    }

//    this for admin
    public function UpdateAnoutPolicy($id)
    {
        $input = Request()->all();
       return $this->about_policy->where('policy_about_id', $id)->update($input);
    }
}