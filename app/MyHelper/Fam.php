<?php

namespace App\MyHelper;

use App\Models\Ministry;
use App\Models\Setting;
use DougSisk\CountryState\CountryStateFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;

class Fam {


    public static function getDefaultImage()
    {
        return asset('find_a_ministry.jpg');
    }

    public static function getBannerImage()
    {
        return asset('find_a_ministry3.jpg');
    }

    public static function activePageIs($page)
    {
        $seg1 = request()->segment(1);
        $seg2 = request()->segment(2);
        if(!empty($seg2) && $seg2 == $page){
            return true;
        }
        elseif(!empty($seg1) && $seg1 == $page){
            return true;
        }
        return false;
    }

    public static function currentPageIs(array $pages)
    {
//        Check if Current route is In Pages Array
      return in_array(Route::getCurrentRoute()->getName(), $pages) ? true : false;
    }

    public static function showAlert($type, $msg)
    {
        $class = 'text-center alert alert-'.$type;
        return '     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="'.$class.'">
               '.$msg.'
            </div>
        </div>
    </div>';
    }



    public static function hash($id)
    {
        $date = date('dMY').'CJ';
        $hash = new Hashids($date, 14);
        return $hash->encode($id);
    }

    public static function decodeHash($str)
    {
        $date = date('dMY').'CJ';
        $hash = new Hashids($date, 14);
        $arr = $hash->decode($str);
        return count($arr) ? $arr[0] : $arr;
    }

    public static function validateMinistry($id, Collection $arr)
    {
        if(!$arr->contains('id', $id) || !$arr->contains('user_id', Auth::user()->id)) {
            return false;
        }
        return true;
}

    public static function generateMinCode($title)
    {
        $data = preg_replace('~\b(\w)|.~', '$1', $title);
        $data = str_split(strtoupper($data));
        if(count($data) > 2){
            return $data[0].$data[1].$data[2].mt_rand(10,999);
        }
        elseif(count($data) > 1){
            return $data[0].$data[1].mt_rand(100,9999);
        }
        return $data[0].mt_rand(100,9999);
    }

    public static function userHasMinHQ()
    {
        return Ministry::where(['user_id' => Auth::user()->id, 'hq' => 1])->count();
    }

    public static function getPublicUploadPath()
    {
        return 'uploads/'.date('Y').'/'.date('m').'/';
    }

    public static function getPublicImagePath()
    {
        return 'storage/uploads/'.date('Y').'/'.date('m').'/';
    }

    public static function getClaimsUploadPath()
    {
        return 'uploads/claims/'.date('Y').'/'.date('m').'/'.Auth::user()->id;
    }

    public static function getFileMetaData($file)
    {
        //$dataFile['name'] = $file->getClientOriginalName();
        $dataFile['ext'] = $file->getClientOriginalExtension();
        $dataFile['type'] = $file->getClientMimeType();
        $dataFile['size'] = self::formatBytes($file->getClientSize());
        return $dataFile;
    }

    public static function getImageSize($bytes)
    {
        return $size = self::formatBytes($bytes);
    }

    public static function randomCode($length = 8, $split = null, $prefix = null)
    {
        $code = '';
        if($split){
            $length = round($length/2);
            $min = str_pad(1, $length, 0);
            $max = str_pad(9, $length, 9);
            $code = mt_rand($min, $max);
            $code2 = mt_rand($min, $max);
            $code = substr($code, 0, $length).$split.substr($code2, 0, $length);
        }
      else{
          $min = str_pad(1, $length, 0);
          $max = str_pad(9, $length, 9);
          $code = mt_rand($min, $max);
      }
        return $code = $prefix ? $prefix.$code : $code;
    }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    public static function getSetting($type)
    {
       return Setting::where('type', $type)->first()->description;
    }

    public static function getSystemName()
    {
        return self::getSetting('system_name');
    }

    public static function getColour($type)
    {
        $data['verified'] = '#00b208';
        return $data[$type];
    }

    public static function defaultValue($type)
    {
        $data['paginate'] = 30;
        return $data[$type];
    }

    public static function show_email($email)
    {
        return '<script type="text/javascript">
        var desiredLink = "mailto:"+"'.$email.'";
        var desiredText = "'.$email.'";
     document.write(\'<a href="\'+desiredLink+\'">\'+desiredText+\'</a>\');
</script>';
    }

    public static function getRandomBGColor()
    {
        $colors = ['primary', 'danger', 'success', 'teal', 'indigo', 'violet', 'purple', 'blue', 'green', 'brown', 'slate', 'grey'];

        return $mix = $colors[rand(0, 11)].'-800';
    }

    public static function getAllCountries()
    {
        return CountryStateFacade::getCountries();
    }

    public static function getCountryStates(string $country_code)
    {
        return CountryStateFacade::getStates($country_code);
    }

    public static function getCountryName(string $country_code)
    {
        return CountryStateFacade::getCountryName($country_code);
    }

    public static function getStateName(string $state_code, string $country_code)
    {
        return CountryStateFacade::getStateName($state_code, $country_code);
    }

    public static function getPanelOptions()
    {
        return '<div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>';
    }

    public static function getPlaceholderImage() : string
    {
        return asset('cj_admin/global_assets/images/placeholders/placeholder.jpg');
    }

    public static function userIsAdmin() : bool
    {
        return (Auth::check() && Auth::user()->role === 'admin');
    }

}
