<?php
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use App\Models\Language;
use App\RssFeedInfo;
use App\Models\StaticOption;
use App\Models\Translation;
use App\Models\MediaUpload;
use Modules\Setting\Entities\EmailTemplate;
use Modules\Setting\Entities\Setting;
use App\Menu;
use App\Page;
use App\Blog;
use App\Facades\GlobalLanguage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
// use View;

//  function __construct()
// {
    
//     $setting = Setting::first();
//     // return $setting;
//      View::share(['setting'=>$setting]);
// }



function all_lang_slugs(){
    return Language::all()->pluck('slug')->toArray();
}
function exist_slugs($model_data){
    return $model_data->lang_all->pluck('lang')->toArray();
}

function purify_html($html){
    return strip_tags(\Mews\Purifier\Facades\Purifier::clean($html));
}

function purify_html_raw($html){
    return \Mews\Purifier\Facades\Purifier::clean($html);
}



// Get settings value
if (!function_exists('get_setting')) {
    function get_setting()
    {
          $setting =  Setting::where('id', 1)->first();

          return $setting->site_title;
    }
}


function setEnvValue(array $values)
{

    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {

            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
        }
    }

    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str)) return false;
    return true;
}


function set_static_option($key, $value)
{
    if (!StaticOption::where('option_name', $key)->first()) {
        StaticOption::create([
            'option_name' => $key,
            'option_value' => $value
        ]);
        return true;
    }
    return false;
}

function get_static_option($key)
{
    global $option_name;
    $option_name = $key;
    $value = \Illuminate\Support\Facades\Cache::remember($option_name, 86400, function () {
        global $option_name;
        return StaticOption::where('option_name', $option_name)->first();
    });

    return !empty($value) ? $value->option_value : null;
}

function get_default_language()
{
    $defaultLang = Language::where('default', 1)->first();
    return $defaultLang->slug;
}
function update_static_option($key, $value)
{
    if (!StaticOption::where('option_name', $key)->first()) {
        StaticOption::create([
            'option_name' => $key,
            'option_value' => $value
        ]);
        return true;
    } else {
        StaticOption::where('option_name', $key)->update([
            'option_name' => $key,
            'option_value' => $value
        ]);
        \Illuminate\Support\Facades\Cache::forget($key);
        return true;
    }
    return false;
}
function delete_static_option($key)
{
    \Illuminate\Support\Facades\Cache::forget($key);
    return (boolean) StaticOption::where('option_name', $key)->delete();
}

function translate($key, $lang = null)
{
    if($lang == null){
        $lang = App::getLocale();
    }

    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

    $translations_default = Cache::rememberForever('translations-'.env('DEFAULT_LANGUAGE', 'en'), function () {
        return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
    });

    if(!isset($translations_default[$lang_key])){
        $translation_def = new Translation;
        $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = $key;
        $translation_def->save();
        Cache::forget('translations-'.env('DEFAULT_LANGUAGE', 'en'));
    }

    $translation_locale = Cache::rememberForever('translations-'.$lang, function () use ($lang) {
        return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
    });

    //Check for session lang
    if(isset($translation_locale[$lang_key])){
        return $translation_locale[$lang_key];
    }
    elseif(isset($translations_default[$lang_key])){
        return $translations_default[$lang_key];
    }
    else{
        return $key;
    }
}

// email template data
if (!function_exists('get_email_template')) {
    function get_email_template($identifier, $colmn_name = null)
    {
        $value = EmailTemplate::where('identifier', $identifier)->first()->$colmn_name;
        return $value;
    }



    function render_image_markup_by_attachment_id($id, $class = null, $size = 'full', $is_lazy= false)
{
    if (empty($id)) return '';
    $output = '';

    $image_details = get_attachment_image_by_id($id, $size);
    if (!empty($image_details)) {
        $lazy_class = $is_lazy ? 'lazy' : '';
        $source = $is_lazy ? 'data-' : '';
        $class_list = !empty($class) ? 'class=" '.$lazy_class.' '. $class . '"' : 'class="'.$lazy_class.'"';
        $output = '<img '.$source.'src="' . $image_details['img_url'] . '" ' . $class_list . '  alt="' . $image_details['img_alt'] . '"/>';
    }
    return $output;
}

function get_attachment_image_by_id($id, $size = null, $default = false)
{
    $image_details = \Illuminate\Support\Facades\Cache::remember('media-uploader-image'.$id,300,function () use ($id){
        return MediaUpload::find($id);
    });
    $return_val = [];
    $image_url = '';

    if (file_exists('/backend/media-uploader/' . optional($image_details)->path)) {
        $image_url = asset('backend/media-uploader/' . optional($image_details)->path);
    }

    if (!empty($id) && !empty($image_details)) {
        switch ($size) {
            case "large":
                if (file_exists('/backend/media-uploader/large-' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/large-' . $image_details->path);
                }
                break;
            case "grid":
                if (file_exists('/backend/media-uploader/grid-' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/grid-' . $image_details->path);
                }
                break;

            case "semi-large":
                if (file_exists('/backend/media-uploader/semi-large-' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/semi-large-' . $image_details->path);
                }
                break;
            case "box":
                if (file_exists('/backend/media-uploader/box-' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/box-' . $image_details->path);
                }
                break;
            case "thumb":
                if (file_exists('/backend/media-uploader/thumb-' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/thumb-' . $image_details->path);
                }else {
                    if (file_exists('/backend/media-uploader/' . $image_details->path)) {
                        $image_url = asset('/backend/media-uploader/' . $image_details->path);
                    }
                }
                break;
            default:
                if (file_exists('/backend/media-uploader/' . $image_details->path)) {
                    $image_url = asset('/backend/media-uploader/' . $image_details->path);
                }
                break;
        }
    }

    if (!empty($image_details)) {
        $return_val['image_id'] = $image_details->id;
        $return_val['path'] = $image_details->path;
        $return_val['img_url'] = $image_url;
        $return_val['img_alt'] = $image_details->alt;
    } elseif (empty($image_details) && $default) {
        $return_val['img_url'] = asset('backend/uploads/user.jpg');
    }

    return $return_val;
}




}