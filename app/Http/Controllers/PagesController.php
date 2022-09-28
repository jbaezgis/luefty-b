<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Tour;
use App\Faq;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Instruction;
use App\Page;
use Config;
use App\Service;
use App\ServicePrice;
use App\Country;
use App\Region;
use App\Http\Controllers\Controller;
use App\Whale;
use App\Location;
use App\Post;
use App\Attraction;
use Illuminate\Support\Facades\DB;
use App\Slider;


use App\http\Requests\CreateMessageRequest;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class PagesController extends Controller
{
    public function servicesTo($id) {
        // $services = Service::where('from', $id)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.is_airport', 'desc')->get();
        return json_encode(Service::where('from', $id)->where('is_airport', 0)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.name', 'asc')->get());
        // return json_encode($services);
    }

    public function servicesToAirports($id) {

        return json_encode(Service::where('from', $id)->where('is_airport', 1)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.name', 'asc')->get());
    }

    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }

    function index()
    {
        return view('email_available');
    }

    function checkemail(Request $request)
    {
        if($request->get('email'))
        {
            $email = $request->get('email');
            $data = DB::table("users")
            ->where('email', $email)
            ->count();
            if($data > 0)
        {
            echo 'not_unique';
        }
        else
        {
            echo 'unique';
        }
        }
    }

    public function home(Request $request, Auction $auctions)
    {
        // SEO
        $title = 'Home';
        $keywords = 'Auctions, Travel, Tourism, Tours';

        $auctions = Auction::from()->open()->active()->get();
        $services = Service::get();
        $countries = Country::get();
        $regions = Region::get();
        $whales = Whale::get();
        $first_slider = Slider::where('order', 1)->where('status', 'Active')->first();
        $sliders = Slider::where('order', '!=', 1)->where('status', 'Active')->get();
        
        $last_tour = Tour::latest()->first();
        $tours = Tour::take(7)->latest()->skip(1)->get();

        // $tours_punta_cana = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Punta Cana')->where('active', 1);
        // })->take(6)->get();

        // $tours_santo_domingo = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Santo Domingo')->where('active', 1);
        // })->take(6)->get();

        $posts = Post::where('published', 1)->take(8)->get();
        // $last_posts = Post::where('published', 1)->last();

        $services_from = Service::join('locations', 'services.from', '=', 'locations.id')->distinct()->get()->unique('from');
        // $services_from = Location::join('services', 'services.from', '=', 'locations.id')->distinct()->get();
        // $services_from = Service::distinct()->get(['from']);
        $services_to = Service::join('locations', 'services.to', '=', 'locations.id')->distinct()->get();

        $locations = Location::where('active', 1)->where('is_airport', NULL)->whereHas('attractions')->take(8)->get();
        
        $last_attraction = Attraction::latest()->first();
        // $attractions = Attraction::latest()->skip(1)->take(6)->get();
        $attractions = Attraction::latest()->take(6)->get();

        // $services_prices = ServicePrice::take(8)->get();
        
        $services_prices = ServicePrice::get();

        $services_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.country_id', 1)->select('*','services.id as s_id')->orderBy('from', 'asc')->take(9)->get();

        return view('home', 
            compact(
                'auctions', 
                'tours', 
                'services',
                'countries',
                'regions', 
                'whales', 
                'services_from', 
                'services_to', 
                'posts', 
                'locations',
                'attractions',
                'last_attraction',
                'services_prices',
                'sliders',
                'first_slider',
                'services_by_country',
                'last_tour'
            ));
    }

    public function homeDesign(Request $request, Auction $auctions)
    {
        $auctions = Auction::from()->open()->active()->get();
        $services = Service::get();
        $countries = Country::get();
        $regions = Region::get();
        $whales = Whale::get();
        $tours = Tour::take(9)->get();

        $tours_punta_cana = Tour::whereHas('locationid', function($q){
            $q->where('name', 'Punta Cana')->where('active', 1);
        })->take(6)->get();

        $tours_santo_domingo = Tour::whereHas('locationid', function($q){
            $q->where('name', 'Santo Domingo')->where('active', 1);
        })->take(6)->get();

        $posts = Post::where('published', 1)->take(8)->get();
        $services_from = Service::join('locations', 'services.from', '=', 'locations.id')->distinct()->get()->unique('from');
        $services_to = Service::join('locations', 'services.to', '=', 'locations.id')->distinct()->get();

        return view('home-design', compact('auctions', 'tours', 'services','countries','regions', 'whales', 'services_from', 'services_to', 'posts', 'tours_punta_cana', 'tours_santo_domingo'));
    }

    public function posts()
    {
        $perPage = 15;
        $posts = Post::paginate($perPage);

        return view('pages.posts', compact('posts'));
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram()
    {
        $url = url('/');

        TelegramMessage::create()
            ->to('8493412723') // Optional.
            ->content("*HELLO!* \n One of your invoices has been paid!") // Markdown supported.
            ->button('Test Subasta', $url);

        return back(); // Inline Button
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function about()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'about')->where('lang', $lang)->first();
        return view('pages.about',compact('page'));

    }

    public function terms()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'terms')->where('lang', $lang)->first();
        return view('pages.terms',compact('page'));
    }

    public function faqs(Faq $faqs)
    {
        $faqs = Faq::all();

        return view('pages.faqs', compact('faqs'));
    }

    public function howworks()
    {
        return view('pages.how_works');
    }

    public function hotel()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'hotel')->where('lang', $lang)->first();
        return view('pages.hotel', compact('page'));
    }

    public function agency()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'agency')->where('lang', $lang)->first();
        return view('pages.agency', compact('page'));
    }

    public function operator()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'operator')->where('lang', $lang)->first();
        return view('pages.operator', compact('page'));
    }

    public function overview()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'overview')->where('lang', $lang)->first();

        return view('pages.overview', compact('page','host'));
    }

    public function privacypolicy()
    {
        $host = request()->getHost();
        $lang = Config::get('app.locale');
        $page = Page::where('code', 'privacy_policy')->where('lang', $lang)->first();
        return view('pages.privacypolicy', compact('page'));
    }

    public function rules()
    {
        return view('pages.rules');
    }

    public function instructions(Request $request, Instruction $instructions)
    {
        // $user = User::findOrFail($id);
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $instructions = Instruction::where('title_en', 'LIKE', "%$keyword%")->orWhere('title_es', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $instructions = Instruction::paginate($perPage);
        }

        return view('pages.instructions', compact('instructions'));
    }

    public function instruction_show($id)
    {
        $instruction = Instruction::findOrFail($id);

        $instruction->views = $instruction->views + 1;

        $instruction->save();

        return view('pages.instruction_show', compact('instruction'));
    }

    public function gps()
    {
        return view('pages.gps');
    }

    public function marketing()
    {
        return view('pages.marketing');
    }

    public function punta_cana()
    {
        return view('pages.punta_cana');
    }

    public function santo_domingo()
    {
        return view('pages.santo_domingo');
    }
}
