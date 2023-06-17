<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class SettingsController extends Controller
{
    public function editShippingMethods($type){
        if($type==='free'){
            $shippingMethod=Setting::where('key','free_shipping_label')->first();
        }
        elseif($type==='local'){
            $shippingMethod=Setting::where('key','local_label')->first();
        }
        elseif($type==='external'){
            $shippingMethod=Setting::where('key','outer_label')->first();
        }
        else {
            $shippingMethod=Setting::where('key','free_shipping_label')->first();
        }
        // return view('dashboard.settings.shippings.edit',[
        //     'shippingMethod'=> $shippingMethod
        // ]);
        return view('dashboard.settings.shippings.edit',compact('shippingMethod'));
    }
    public function updateShippingMethods(ShippingsRequest $Request, $id){
        $shipping = Setting::findOrFail($id);
        $shipping -> update([
            'plain_value' => $Request -> plain_value,
            'value' => $Request -> value,
    ]);
    // الحل الاسهل لأنه يرجعنا لنفس الرابط السابق مع الارغيومينت وكلشي ومعه أيضا رسالة تنبيه بالنجاح
    return redirect() -> back() -> with(['success' => 'it was done successful']);
    // الحل الاسهل لأنه يرجعنا لنفس الرابط السابق مع الارغيومينت وكلشي ومعه أيضا رسالة تنبيه بالنجاح


    ###################################هذا الحل ابتكاري الشخصي لحل مشكلة الارغيومينت########################################
    // if ($shipping -> key ==='free_shipping_label') {
        //     $type = 'free';
        // }
        // elseif($shipping -> key ==='local_label'){
        //     $type = 'local';
        // }
        // elseif($shipping -> key ==='outer_label'){
            //     $type = 'external';
            // }
            // return redirect() -> route('edit.shippings.methods',compact('type'));
    ###################################هذا الحل ابتكاري الشخصي لحل مشكلة الارغيومينت########################################
            
    }
}