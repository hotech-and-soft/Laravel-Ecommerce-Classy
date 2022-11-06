<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Slider::insert([
            [
                'subtitle' => 'Slider Subtitle',
                'title' => 'Slider Title',
                'details' => 'Slider Details',
                'photo' => 'slider.jpg',
                'bg_color' => 'bg-white',
                'position' => 1,
                'link' => 'https://www.google.com',
            ],
            [
                'subtitle' => 'Slider Subtitle',
                'title' => 'Slider Title',
                'details' => 'Slider Details',
                'photo' => 'slider.jpg',
                'bg_color' => 'bg-white',
                'position' => 1,
                'link' => 'https://www.google.com',
            ],
            [
                'subtitle' => 'Slider Subtitle',
                'title' => 'Slider Title',
                'details' => 'Slider Details',
                'photo' => 'slider.jpg',
                'bg_color' => 'bg-white',
                'position' => 1,
                'link' => 'https://www.google.com',
            ],
        ]);
    }    
    }