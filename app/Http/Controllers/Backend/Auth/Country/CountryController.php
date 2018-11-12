<?php

namespace App\Http\Controllers\Backend\Auth\Country;

use App\Http\Requests\Backend\Auth\Country\CountryAdminRequest;
use App\Http\Requests\Backend\Auth\Country\ManageCountryRequest;
use App\Http\Requests\Backend\Auth\Country\StoreCountryRequest;
use App\Http\Requests\Backend\Auth\Country\UpdateCountryRequest;
use App\Models\Auth\Country;
use App\Models\Auth\HasAdminLevel;
use App\Repositories\Backend\Auth\CountryAdminLevelRepository;
use App\Repositories\Backend\Auth\CountryRepository;
use App\Repositories\Backend\Auth\HasAdminLevelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{


    /**
     * @var countryRepository
     *
     */
    protected  $countryRepository;


    /**
     * @var hasAdminLevelRepository
     *
     */
    protected  $hasAdminLevelRepository;

    /**
     * @var CountryAdminLevelRepository
     *
     */
    protected  $countryAdminLevelRepository;

    /**
     * @param CountryRepository countryRepository
     *
     */
    public function __construct(CountryRepository $countryRepository,
                                HasAdminLevelRepository $adminLevelRepository,
                                CountryAdminLevelRepository $countryAdminLevelRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->hasAdminLevelRepository = $adminLevelRepository;
        $this->countryAdminLevelRepository = $countryAdminLevelRepository;
    }

    /**
     * @param ManageCountryRequest $request
     *
     * @return mixed
     *
     * */
    public function index(ManageCountryRequest $manageCountryRequest)
    {
        return view('backend.auth.country.index')
            ->withCountries($this->countryRepository
            ->OrderBy('id','asc')
            ->paginate('25'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.auth.country.create');

    }

    /**
     * @param StoreCountryRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreCountryRequest $request)
    {

        $country = $this->countryRepository->create($request->only('name','iso_code','admin_level','avg_gate_price','currency'));

        if($country)
        {
             $level = array($request->only('levels'));
             $level1 = $level[0];

             $levels = $level1["levels"];

             foreach ($levels  as $level)
             {
                 $this->hasAdminLevelRepository->create(['country_id'=>$country->id,'name'=>$level]);
             }

         }



        return redirect()->route('admin.auth.country.index')->withFlashSuccess(__('alerts.backend.countries.created'));

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
    public function edit(ManageCountryRequest $request,Country $country)
    {
        //
        return view('backend.auth.country.edit')
            ->withCountry($country);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        //
        $this->countryRepository->update($country, $request->only('name','iso_code','currency','avg_gate_price'));
        return redirect()->route('admin.auth.country.index')->withFlashSuccess(__('alerts.backend.countries.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ManagePermissionRequest $request
     * @param  Permission $permission
     * @return mixed
     */
    public function destroy(UpdateCountryRequest $request,Country $country)
    {
        $this->countryRepository->deleteById($country->id);

        //  event(new RoleDeleted($role));

        return redirect()->route('admin.auth.country.index')->withFlashSuccess(__('alerts.backend.countries.deleted'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CountryAdminRequest $request
     * @param  Country $country
     * @return mixed
     */
    public function storeCountryAdmin(CountryAdminRequest $request)
    {


        $countryadmin = $this->countryAdminLevelRepository->create($request->only('name','admin_level_1','parent','country_id'));

        if($countryadmin)
        {

        }



        return redirect()->route('admin.auth.country.index')->withFlashSuccess(__('alerts.backend.countries.created'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CountryAdminRequest $request
     * @param  Country $country
     * @return mixed
     */
    public function createCountryAdmin(CountryAdminRequest $request,Country $country)
    {

        $admin_data = $country->countryAdmin()->get();
       //$admin_level = $country
        $country_id = $country->id;
       // $none = 'none';



        $adata = array();

         foreach ($admin_data as $data)
         {
            $adata[$data->level] = $data->name;

         }

       return view('backend.auth.country.cadmin')->with('admininfo',$adata)->with('country',$country_id);

    }


    public function getUpperLevelData($level,$country)
    {
        $lev = (int)$level;
        $country = (int)$country;
        $upperlevel =  $lev - 1;
        $levelname =  $this->hasAdminLevelRepository->where('level',$upperlevel,'=')->
                      where('country_id',$country,'=')->get();
        $details = $this->countryAdminLevelRepository->where('type',$levelname[0]->name,'=')->get();
        //dd($details);
        return $details;
    }


}
