<?php

namespace App\Enums;

enum OrderStatusEnum: int
{

    case new = 1;
    case pending = 2;
    case lake_of_documents=3;
    case power_of_attorney  = 4;
    case done = 5;

    public function label(): string
    {
        return match ($this) {
            self::new => __('admin.new'),
            self::pending => __('admin.pending'),
            self::lake_of_documents => __('admin.lake_of_documents'),
            self::power_of_attorney => __('admin.power_of_attorney'),
            self::done => __('done.data_completion_user'),
        };
    }
}
