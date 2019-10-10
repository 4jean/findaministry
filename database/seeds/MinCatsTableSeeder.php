<?php

use App\Models\MinCat;
use Illuminate\Database\Seeder;

class MinCatsTableSeeder extends Seeder
{

    public function run()
    {
        $cats = ['Missions', 'Missionaries', 'Youth', 'Women', 'Men' ,'Parenting', 'Children', 'Evangelism', 'Discipleship', 'Students', 'Marriage and family', 'Singles', 'Addicts', 'Prison', 'Prayer', 'Healing', 'Deliverance', 'Counseling School', 'Bus Ministry', 'Widows', 'Orphans', 'Aged and Senior Citizens', 'Hospital', 'Faith Clinics', 'Lunch Hour', 'Fellowship', 'Campus Fellowship', 'Physically Challenged', 'Blind', 'Deaf and Dumb', 'Pastors Fellowship', 'Leadership', 'Health', 'Sports', 'Music', 'Media', 'Drama' ,'Television', 'Radio', 'Online', 'Church'];

        foreach ($cats as $cat) {
            MinCat::create(['name' => $cat, 'slug' => Str::slug($cat)]);
        }
    }
}
