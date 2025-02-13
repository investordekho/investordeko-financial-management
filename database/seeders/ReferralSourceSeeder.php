<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferralSourceSeeder extends Seeder
{
    public function run()
    {
        $sources = [
            'Friend/Family',
            'Social Media (Facebook, Instagram, Twitter, etc.)',
            'Online Search (Google, Bing, etc.)',
            'Advertisement (TV, Radio, Print)',
            'Email Newsletter',
            'Event/Seminar',
            'Professional Referral (Doctor, Lawyer, etc.)',
            'Blog/Website',
            'Direct Mail',
            'Company Website'
        ];

        foreach ($sources as $source) {
            DB::table('referral_sources')->insert([
                'source_name' => $source,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
