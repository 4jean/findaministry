<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [

          [
              'type' => 'phone1',
              'description' => '12345678901'
          ],

            [
                'type' => 'system_email',
                'description' => 'info@findaministry.com'
            ],

            [
                'type' => 'no_reply_email',
                'description' => 'no-reply@findaministry.com'
            ],

            [
                'type' => 'contact_email',
                'description' => 'contact@findaministry.com'
            ],

            [
                'type' => 'system_name',
                'description' => 'Find A Ministry'
            ],

            [
                'type' => 'phone2',
                'description' => '07065435559'
            ],

            [
                'type' => 'address',
                'description' => 'Find A Ministry Abuja'
            ],

            [
                'type' => 'fb_page',
                'description' => 'http://fb.me/findaministry'
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
