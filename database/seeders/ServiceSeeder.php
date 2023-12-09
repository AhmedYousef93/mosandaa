<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
               
                'title_ar' => 'قسم الاستشارات',
                'title_en' => 'Consulting Department',
                'description_ar' => 'description_ar',
                'description_en' => 'description_en',
                'subservices' => [
                    [
                        'title_ar' => 'جلسه الاستشاره القانونيه الحضوريه',
                        'title_en' => 'Physical legal consultation session',
                        'description_ar' => 'description_ar',
                        'description_en' => 'description_en',
                    ],
                    [
                        'title_ar' => 'جلسه الاستشاره القانونيه عبر الفيديو',
                        'title_en' => 'Video legal consultation session',
                        'description_ar' => 'description_ar',
                        'description_en' => 'description_en',
                    ],
                    [
                        'title_ar' => 'جلسه الاستشاره القانونيه المكتوبة',
                        'title_en' => 'Written legal consultation session',
                        'description_ar' => 'description_ar',
                        'description_en' => 'description_en',
                    ],
                ],
            ],
            [
                'title_ar' => 'قسم التقاضي',
                'title_en' => 'Litigation Section',
                'description_ar' => 'description_ar',
                'description_en' => 'description_en',
                'subservices' => [
                    [
                        'title_ar' => 'خدمات دراسه القضايا',
                        'title_en' => 'Case Study Services',
                        'description_ar' => 'description_ar',
                        'description_en' => 'description_en',
                    ],
                    [
                        'title_ar' => 'خدمات القضايا',
                        'title_en' => 'Case Services',
                        'description_ar' => 'description_ar',
                        'description_en' => 'description_en',
                    ],
                ],
            ],
            [
                'title_ar'=>'قسم التسويه الوديه',
                'title_en'=>'Amicable Settlement Section',
                'description_ar'=>'description_ar',
                'description_en'=>'description_en',
                'subservices' => [
                   
                ],
            ],
            [
                'title_ar'=>'قسم المتابعه الادراية',
                'title_en'=>'Department of administrative follow-up',
                'description_ar'=>'description_ar',
                'description_en'=>'description_en',
                'subservices' => [
                   
                ],
            ],
            // Add more services as needed
        ];

        foreach ($services as $serviceData) {
            $service = Service::create([
                'title_ar' => $serviceData['title_ar'],
                'title_en' => $serviceData['title_en'],
                'description_ar' => $serviceData['description_ar'],
                'description_en' => $serviceData['description_en'],
            ]);

            foreach ($serviceData['subservices'] as $subserviceData) {
                Subservice::create([
                    'service_id' => $service->id,
                    'title_ar' => $subserviceData['title_ar'],
                    'title_en' => $subserviceData['title_en'],
                    'description_ar' => $subserviceData['description_ar'],
                    'description_en' => $subserviceData['description_en'],
                ]);
            }
        }
    }




}


   