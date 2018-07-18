<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use App\SoicalMedia;

class ContactUsController extends Controller
{
    //
    public function __construct()
    {
        $this->contact_us = new ContactUs();
        $this->socialmedial = new SoicalMedia();

    }

    public function index()
    {

        return view('contactus.contactus');
    }

    public function SocialMeidaIndex()
    {

        return view('socialmedia.socialmedia');
    }

    public function get()
    {
        return $this->contact_us->all();

    }

    public function create()
    {
        return $this->contact_us->create($input = Request()->all());

    }

    public function update($id)
    {
        $this->contact_us->find($id)->update($input = Request()->all());

    }

    public function delete($id)
    {
        $this->contact_us->find($id)->delete();

    }

    public function GetSocialMedia()
    {
        $output = $this->socialmedial->get();
        return $output['0'];
    }

    public function updateSoical($id)
    {
        $this->socialmedial->find($id)->update($input = Request()->all());
    }


    public function SendMessage()
    {

        $input = Request()->all();
        return ['state' => '202'];
    }
}
