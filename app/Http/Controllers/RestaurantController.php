<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index()
    {
        return Restaurant::all();
    }

    public function list_state()
    {
        // เก็บข้อมูลไว้ใน cache
        $state = cache()->remember('restaurants', now()->addDay(), function () {
            return DB::table('restaurants')->select('state')->distinct()->get();
        });
        $items = [];
        foreach ($state as $list_state) {
            $items[] = $list_state->state;
        }
        return $items;
    }

    public function search_restaurants($state)
    {
        $restaurants = DB::table('restaurants')
             ->where('state', '=', $state)
             ->get();
             foreach ($restaurants as $list_restaurant) { // loop เช็คร้านเปิดหรือยัง
                $open = date_create($list_restaurant->open); //รับค่า String เวลาเปิดร้านมาแปลงเป็น date
                $close = date_create($list_restaurant->close); //รับค่า String เวลาปิดร้านมาแปลงเป็น date
                $time_open = date_format($open,"H:i:s"); //นำเวลาเปิดร้านมาแปลง format
                $time_close = date_format($close,"H:i:s"); //นำเวลาปิดร้านมาแปลง format
                $time_now = date( format: 'H:i:s'); //ประกาศรับค่าเวลาปัจจุบัน
                    if ($time_now > $time_open && $time_open < $time_close) // ถ้าเวลาปัจจุบันมากกว่าหรือเท่าเปิดร้านและน้อยกว่าหรือเท่ากับเวลาปิดร้าน
                    {
                        $list_restaurant->open_shop = true; //เซตค่าเท่ากับ true
                    } else {
                        $list_restaurant->open_shop = false; //ถ้าไม่เข้าเงื่อนไขเซตค่าเท่ากับ false
                    }
                    
                 
             }
        return $restaurants;
    }
}
