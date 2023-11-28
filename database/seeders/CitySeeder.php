<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a city with related area and state
        $this->createCityWithAreaAndState('جده', 'gada', 'المنطقه الاولي', 'area one', 'الحي الاولي', 'state one');
    }

    /**
     * Create a city with related area and state.
     *
     * @param string $cityTitleAr
     * @param string $cityTitleEn
     * @param string $areaTitleAr
     * @param string $areaTitleEn
     * @param string $stateTitleAr
     * @param string $stateTitleEn
     * @return void
     */
    private function createCityWithAreaAndState(
        string $cityTitleAr,
        string $cityTitleEn,
        string $areaTitleAr,
        string $areaTitleEn,
        string $stateTitleAr,
        string $stateTitleEn
    ) {
        // Create city
        $city = City::create([
            'title_ar' => $cityTitleAr,
            'title_en' => $cityTitleEn,
        ]);

        // Create area related to the city
        $area = $city->areas()->create([
            'city_id' => $city->id,
            'title_ar' => $areaTitleAr,
            'title_en' => $areaTitleEn,
        ]);

        // Create state related to the city and area
        $area->states()->create([
            'city_id' => $city->id,
            'area_id' => $area->id,
            'title_ar' => $stateTitleAr,
            'title_en' => $stateTitleEn,
        ]);
    }
}
