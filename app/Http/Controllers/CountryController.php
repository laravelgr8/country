<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CountryController extends Controller
{
    public function index()
    {
        $data=DB::table('country')->get();
        return view('home',["data"=>$data]);
    }
    public function getstate(Request $request)  //for state fetch
    {
        $country_id=$request->cid;
        $data=DB::table('state')->where('country_id',$country_id)->get();
        $html="<option>Select State</option>";
        foreach($data as $sdata)
        {
            $html.="<option value='".$sdata->id."'>".$sdata->state_name."</option>";
        }
        echo $html;
    }

    public function getcity(Request $request)  //for city fetch
    {
        $state_id=$request->sid;
        $data=DB::table('city')->where('state_id',$state_id)->get();
        $html="<option>Select City</option>";
        foreach($data as $cdata)
        {
            $html.="<option value='".$cdata->id."'>".$cdata->city_name."</option>";
        }
        echo $html;
    }

    public function insert(Request $request)
    {
        $name=$request->name;
        $country=$request->country;
        $state=$request->state;
        $city=$request->city;
        $data=DB::table('student')->insert([
            "name"=>$name,
            "country"=>$country,
            "state"=>$state,
            "city"=>$city
        ]);
    }


    //for show
    public function show()
    {
        $data=DB::table('student')
                ->select('student.id as sid','student.name as name','country.country_name as country_name','state.state_name as state_name','city.city_name as city_name')
                ->join('country','country.id','=','student.country')
                ->join('state','state.id','=','student.state')
                ->join('city','city.id','=','student.city')
                ->get();
        return $data;
    }

    //for edit data show
    public function edit($id)
    {
        $country=DB::table('country')->get();
        $state=DB::table('state')->get();
        $city=DB::table('city')->get();
        $data=DB::table('student')
                ->select('student.id as sid','student.name as name','country.country_name as country_name','state.state_name as state_name','city.city_name as city_name','student.country as country','student.state as state','student.city as city')
                ->join('country','country.id','=','student.country')
                ->join('state','state.id','=','student.state')
                ->join('city','city.id','=','student.city')
                ->where('student.id',$id)
                ->get();
        return view('edit',["data"=>$data,"country_data"=>$country,"state_data"=>$state,"city_data"=>$city]);
    }


    //for edit page

}
