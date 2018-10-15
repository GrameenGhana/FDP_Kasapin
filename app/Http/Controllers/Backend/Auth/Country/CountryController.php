<?php

namespace App\Http\Controllers\Backend\Auth\Country;

use App\Http\Requests\Backend\Auth\Country\ManageCountryRequest;
use App\Http\Requests\Backend\Auth\Country\StoreCountryRequest;
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
     * @param CountryRepository countryRepository
     *
     */
    public function __construct(CountryRepository $countryRepository,HasAdminLevelRepository $adminLevelRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->hasAdminLevelRepository = $adminLevelRepository;
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
        //
         $country = $this->countryRepository->create($request->only('name','iso_code','admin_level','avg_gate_price','currency'));

         if($country)
         {
             $levels = $request->only('levels');

             \Log::info('Admin Level ' . $levels);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
