<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialNetwork::create([
            'facebook' => 'https://facebook.com/ejemplo',
            'tiktok' => 'https://tiktok.com/@ejemplo',
            'instagram' => 'https://instagram.com/ejemplo',
            'youtube' => 'https://youtube.com/c/ejemplo',
            'twitter' => 'https://twitter.com/ejemplo',
            'linkedin' => 'https://linkedin.com/in/ejemplo',
        ]);
    }
}
