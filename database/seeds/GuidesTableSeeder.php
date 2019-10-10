<?php

use Illuminate\Database\Seeder;

class GuidesTableSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'name' => 'set_page_name',
                'slug' => 'choosing-a-page-name-for-your-ministry',
                'title' => 'Choosing A Page Name For Your Ministry',
                'content' => 'When you first set up a Ministry for yourself, Find A Ministry gives you a url that looks something like this…..http://www.findaministry.com/FAM123. Not very easy to remember, and certainly not something you could tell your friends to visit. However, once your Page has been VERIFIED you are able to claim your own unique Ministry UR',
            ],

            [
                'name' => 'guides.verify_ministry',
                'slug' => 'how-to-verify-a-ministry',
                'title' => 'How To Verify A Ministry',
                'content' => 'We want people to find your Ministry easily, because Verified/Claimed Ministries are displayed at the top of search results.
You can Claim This Ministry in any of the following ways :
Upload a letter Headed document requesting Approval of Your Ministry Your Documents will be kept Confidential
Send a Message from your official Facebook Page to our Facebook Page stating the Ministry name and code you wish to claim. You will receive a reply as soon as possible',
            ],
        ];

       DB::table('guides')->insert($data);
    }
}
