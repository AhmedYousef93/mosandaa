<?php

namespace App\Services;

use App\Models\Address;
use Auth;

class AddressService
{
    public function createAddress(array $data): Address
    {

        $user = Auth::user();

        $addressData = [
            'city_id' => $data['city_id'] ?? null,
            'area_id' => $data['area_id'] ?? null,
            'state_id' => $data['state_id'] ?? null,
            'street' => $data['street'] ?? null,
            'building_number' => $data['building_number'] ?? null,
            'primary' => $data['primary'] ?? 1,
        ];

        $address = $user->addresses()->create($addressData);

        return $address;

    }

    public function updateAddress(int $addressId, array $data): Address
    {
        $address = Address::findOrFail($addressId);
        $address->update($data);

        return $address;
    }

    public function deleteAddress(int $addressId): bool
    {
        $address = Address::findOrFail($addressId);
        $address->delete();

        return true;
    }

    public function getAddressById(int $id): ?Address
    {
        return Address::find($id);
    }
}