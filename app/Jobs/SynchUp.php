<?php

namespace App\Jobs;

use App\Models\Queuetest;
use App\Repositories\Backend\Survey\SurveySynchupRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SynchUp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 protected $survey;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $formdata;
    public function __construct(array  $formdata)
    {

        $this->formdata = $formdata;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SurveySynchupRepository $survey)

    {
           $combine = array();
           $dat = $this->formdata;
       //foreach($dat['data']['farmer_c'] as $value){
        foreach($dat['data'] as $val) {
            foreach ($val['farmer_c'] as $value) {
                $combine[$value['field_name']] = $value['answer'];
            }
        }
       $combine['start_date_c']=$dat['submission']['Start__c'];
        $combine['surveyor_id']=$dat['submission']['Surveyor__c'];
       $combine['respondent_id']=$dat['data'][0]['external_id'];
       $combine['country_admin_level_id'] = 1;
      if($survey->surveyExist($dat['data'][0]['external_id']) > 0){
         $res = $survey->updateById($dat['data'][0]['external_id'],$combine);
          $action = 'data update received on modifications: ';
      }
      else {
          $res = $survey->create($combine);
          $action = 'data created received on insertion: ';
      }
        Log::info($action.json_encode($res));
    }
}
