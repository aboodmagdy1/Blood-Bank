<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use function App\utils\responseJson;



class MainController extends Controller
{
    public function governorates()
    {

        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {
        $cities = City::where(function ($qurery) use ($request) {
            if ($request->has('governorate_id')) {
                $qurery->where('governorate_id', $request->governorate_id);
            }
        })->get();

        return responseJson(1, 'success', $cities);
    }

    public function bloodTypes(Request $request)
    {
        $bloodTypes = BloodType::all();
        return responseJson(1, 'success', $bloodTypes);
    }

    public function categories(Request $request)
    {

        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }

    public function settings()
    {
        $settings = Setting::all();
        return responseJson(1, 'success', $settings);
    }
    public function contact(Request $request)
    {
        // 1)validate the request
        $rules = [
            'subject' => ['required', 'string'],
            'message' => ['required', 'string']
        ];
        $request->validate($rules);

        // 2)  get client data to send with request 
        $client = $request->user();


        // 3) create Contact request 
        $contact = Contact::create([
            'name' => $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
            'message' => $request->input('message'),
            'subject' => $request->input('subject'),
        ]);

        // 4) return response
        return responseJson(1, 'Your message has been sent successfully');
    }
    // dispaly contact details for client 
    public function contactInfo()
    {
        $settings = Setting::first();
        return responseJson(1, 'contact info', [
            "phone" => $settings->phone,
            "email" => $settings->email,
            "fb_link" => $settings->fb_link,
            "tw_link" => $settings->tw_link,
            "insta_link" => $settings->insta_link,
            "watts_link" => $settings->watts_link,
            "youtube_link" => $settings->youtube_link,
        ]);
    }
    public function about()
    {
        $about_text = "Veniam aliquid molestiae occaecati nobis. Ut quod vel repellendus voluptatem eum. Praesentium deserunt doloribus assumenda et reiciendis laudantium dolore. Et totam praesentium nemo. Assumenda eius ipsam recusandae et sunt. Aut expedita doloribus repellendus. Aperiam quia minima nam.";

        return responseJson(1, 'about app', [
            "about_app" => $about_text,
        ]);
    }
}
