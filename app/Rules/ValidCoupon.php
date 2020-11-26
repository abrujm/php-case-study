<?php

namespace App\Rules;

use App\Models\Coupons;
use Illuminate\Contracts\Validation\Rule;

class ValidCoupon implements Rule
{

    private $origin_latitude;

    private $origin_longitude;

    private $destination_latitude;

    private $destination_longitude;

    private $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
      $origin_latitude,
      $orgin_longitude,
      $destination_latitude,
      $destination_longitude
    ) {
        $this->origin_latitude = $origin_latitude;
        $this->origin_longitude = $orgin_longitude;
        $this->destination_latitude = $destination_latitude;
        $this->destination_longitude = $destination_longitude;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->activeCoupon($value)) {
            return $this->validCouponCode($value);
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trim($this->message) ? $this->message : 'Invalid Coupon';
    }

    private function activeCoupon($value)
    {
        $this->message = "Coupon Expired";

        return (Coupons::activeCouponCode($value)->coupon_code) ?? false;
    }

    private function validCouponCode($coupon_code)
    {
        $this->message = "Coupon not applicable for this trip";

        return (Coupons::validCouponCode($coupon_code, $this->origin_latitude,
            $this->origin_longitude, $this->destination_latitude,
            $this->destination_longitude)->coupon_code ?? false);
    }
}
