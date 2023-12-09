<?php

namespace App\Enums;

enum OrderStatusEnum: int
{

    case new = 1;
    case pending = 2;
    case lake_of_documents=3   ;
    case power_of_attorney  = 4;
    case done = 5;

    public function label(): string
    {
        return match ($this) {
            self::pending => __('admin.new'),
            self::reject => __('admin.pending'),
            self::accept => __('admin.lake_of_documents'),
            self::data_completion => __('admin.power_of_attorney'),
            self::data_completion_user => __('done.data_completion_user'),
        };
    }
}
