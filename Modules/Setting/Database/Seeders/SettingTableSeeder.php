<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        DB::table('settings')->insert([

            'site_url' => "acechemicals.in",
            'site_email' => 'ashwanikhanna@acechemicals.in',
            'title' => "You are Welcome to make an infection free green planet .",
            'meta_keywords' => 'Ace Chemicals Agencies is a leading  supplier of world class eco-friendly disinfection solutions having a diverse experience of decades for complete aerial, water and surface, Equipments, Linen etc. disinfection.',
            'meta_description' => 'Technique matters too !!! Eco-friendly products are not everything, how they are used is equally important.
            Always follow protocols and guidelines to get the best results. We are committed to a healthy environment.',
            'meta_author' => 'Ashwani Khanna',
            'address' => '2/33, Shivam Chambers,Noida, U.P',
            'phone' => '+91-98111 88099',
            'timezone' => 'Asia/Kollatta',
            'language' => 'Hindi',
            'footer_text' => 'Copyrights Reserved 2022-23 | Developed by :- https://kikde.com',  
            'facebook_url'=>'facebook_url',
            'insta_url'=>'insta_url',
            'linkdin_url'=>'linkdin_url',
            'twitter'=>'twitter',


    ]);
    }
}
