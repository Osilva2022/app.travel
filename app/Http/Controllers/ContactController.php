<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\Models\Contact;
use DateTime;

class ContactController extends Controller
{
    public function contact()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $subjects = DB::select('SELECT * FROM travel_contact_subject;');
        metadatos(
            'Contact Us | Tribune Travel',
            "Do you have something to tell us? We would love to hear from you! Please leave us a message.",
            config('constants.DEFAULT_IMAGE'),
            route('contact'),
            route('contact')
        );
        return view('contact.index', compact('destinations_data', 'categories_data', 'subjects'));
    }

    public function storeContact(Request $request)
    {
        request()->validate(Contact::$rules);
        $email = $request->email;

        $validate = DB::select("SELECT * FROM travel_contact_info WHERE email = '$email' ");

        if (!$validate) {
            $contact = Contact::create($request->all())->id;
            $this->send_email($request);
        } else {
            $this->send_email($request);
        }

        return redirect()->route('contact')->with([
            'success' => 'Thank you for contacting us. We will get back to you soon.'
        ]);
    }

    public function subscription()
    {

        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');

        return view('subscriptions.index', compact('destinations_data', 'categories_data'));
    }

    public function saveSubscription(Request $request)
    {

        $categories_data = returndata('categories');
        $destinations_data = returndata('destinations');
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
        ]);
        if ($request->category == "") {
            return redirect()->route('subscription')->with([
                'error' => "You did not select a category"
            ]);
        }
        $user_subscription = DB::select('SELECT id_subscriptions,status FROM tribunetravel_wp.travel_subscriptions WHERE email = ?', [$request->email]);
        $now = new DateTime();
        if ($user_subscription) {
            if ($user_subscription[0]->status == 1) {
                $id_subscription =  $user_subscription[0]->id_subscriptions;
            } elseif ($user_subscription[0]->status == 0) {
                DB::update('update tribunetravel_wp.travel_subscriptions set status = ? where id_subscriptions = ?', [true, $user_subscription[0]->id_subscriptions]);
                $id_subscription =  $user_subscription[0]->id_subscriptions;
            }
        } else {
            $id_subscription = DB::table('travel_subscriptions')->insertGetId(
                [
                    'full_name' => $request->fullname,
                    'email' => $request->email,
                    'status' => true,
                    'subscription_date' => $now->format('Y-m-d H:i:s'),
                ]
            );
        }


        for ($i = 0; $i < count($request->category); $i++) {
            $subscriptions = check_subscription($request->email, $request->category[$i]);
            if (($subscriptions[0] == "")) {
                DB::insert('INSERT INTO `tribunetravel_wp`.`travel_subscriptions_category`(`id_subscription`,`id_term`,`created`,`status`)VALUES(?,?,?,?);', [$id_subscription, $request->category[$i], $now->format('Y-m-d H:i:s'), true]);
            } elseif ($subscriptions[0] != "" && $subscriptions[0]->status == 0) {
                DB::update('update tribunetravel_wp.travel_subscriptions_category set status = ? where id_subscription = ? and id_term = ?', [true, $user_subscription[0]->id_subscriptions, $request->category[$i]]);
            }
        }
        return redirect()->route('subscription')->with([
            'success' => 'Thanks for subscribing'
        ]);


        return view('subscriptions.index', compact('destinations_data', 'categories_data'));
    }

    public function unsubscribe()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');


        return view('subscriptions.unsubscribe', compact('destinations_data', 'categories_data'));
    }
    
    public function saveUnsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user_subscription = DB::select('SELECT id_subscriptions FROM tribunetravel_wp.travel_subscriptions WHERE email = ? and status = 1', [$request->email]);
        if ($user_subscription) {
            DB::update('update tribunetravel_wp.travel_subscriptions set status = ? where id_subscriptions = ?', [false, $user_subscription[0]->id_subscriptions]);
            DB::update('update tribunetravel_wp.travel_subscriptions_category set status = ? where id_subscription = ?', [false, $user_subscription[0]->id_subscriptions]);
            return redirect()->route('unsubscribe')->with([
                'success' => "we're so sorry you're leaving"
            ]);
        } else {
            return redirect()->route('unsubscribe')->with([
                'error' => "Your email is not subscribed"
            ]);
        }
    }
}
