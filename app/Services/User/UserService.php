<?php

namespace App\Services\User;


use App\Models\UserDetails;
use Carbon\Carbon;

class UserService
{


    public function storeUserDetails(array $data, int $userId): void
    {
        UserDetails::updateOrCreate(
            ['user_id' => $userId],
            [
                'id_number' => $data['id_number'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'nationality' => $data['nationality'] ?? null,
                'sponsor_name' => $data['sponsor_name'] ?? null,
                'national_address' => $data['national_address'] ?? null,
                'date_of_entering' => $data['date_of_entering'] ?? null,
                'passport_number' => $data['passport_number'] ?? null,
                'salary' => $data['salary'] ?? null,
                'sponsor_residence' => $data['sponsor_residence'] ?? null,
                'labor_city' => $data['labor_city'] ?? null,
            ]
        );
    }

}
