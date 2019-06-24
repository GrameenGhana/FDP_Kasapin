<?php

namespace App\Helpers\General;

use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Class HtmlHelper.
 */
class SynchData
{
    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * HtmlHelper constructor.
     *
     * @param UrlGenerator|null $url
     */
    public function __construct(UrlGenerator $url = null)
    {
        $this->url = $url;
    }

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */

    public static function check_variable_data($data)
    {

        if($data == '--' || $data== '-select-' || $data == 'N/A'){

            return 1;
        }
        else{

            return 0;
        }
    }


    public static function split_gps($data)
    {

        if($data != ''){

           $splitter = explode(',',$data);
           return $splitter;
        }
        else{
            return $data;
        }
    }
}
