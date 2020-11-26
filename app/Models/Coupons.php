<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupons extends Model
{

    use HasFactory;

    static $ACTIVE = 1;

    static $INACTIVE = 0;


    protected $primaryKey = 'id';

    protected $table = 'coupons';

    public $fillable = [
      'coupon_code',
      'coupon_amount',
      'event_id',
      'start_date',
      'end_date',
      'valid_distance',
    ];

    public static function addCoupon($input)
    {
        return self::create($input);
    }

    public static function deactivateCoupon($coupon_id)
    {
        $coupon = self::getCouponByStatusAndId($coupon_id, self::$ACTIVE);

        if ($coupon) {
            self::select('id')
              ->where('is_active', self::$ACTIVE)
              ->where('id', $coupon_id)
              ->update(['is_active' => self::$INACTIVE]);

            return "Coupon deactivated";
        }

        return "Coupon not found";
    }

    public static function activateCoupon($coupon_id)
    {
        $coupon = self::getCouponByStatusAndId($coupon_id, self::$INACTIVE);

        if ($coupon) {
            self::select('id')
              ->where('is_active', self::$INACTIVE)
              ->where('id', $coupon_id)
              ->update(['is_active' => self::$ACTIVE]);

            return "Coupon activated";
        }

        return "Coupon not found";
    }

    private static function getCouponByStatusAndId($coupon_id, $status)
    {
        return self::select('id')
          ->where('is_active', $status)
          ->where('id', $coupon_id)
          ->first();

    }

    public static function getActiveCoupons()
    {
        $date = date('Y-m-d');

        return self::select('coupon_code', 'coupon_amount', 'event_id',
          'start_date', 'end_date', 'valid_distance')
          ->where('start_date', '<=', $date)
          ->where('end_date', '>=', $date)
          ->where('is_active', self::$ACTIVE)
          ->get();
    }

    public static function activeCouponCode($coupon_code)
    {
        $date = date('Y-m-d');

        return self::select('coupon_code')
          ->where('coupon_code', $coupon_code)
          ->where('start_date', '<=', $date)
          ->where('end_date', '>=', $date)
          ->where('is_active', self::$ACTIVE)
          ->first();
    }

    //
    public static function validCouponCode(
      $coupon_code,
      $origin_latitude,
      $origin_longitude,
      $destination_latitude,
      $destination_longitude
    ) {
        $valid_coupon = new Coupons();

        $valid_coupon = $valid_coupon
          ->join('events', 'events.id', '=', 'coupons.event_id')
          ->select('coupon_code')
          ->where('coupon_code', $coupon_code)
          ->where(function ($q) use (
            $origin_latitude,
            $origin_longitude,
            $destination_latitude,
            $destination_longitude
          ) {
              $q->where(DB::raw("ST_Contains(ST_Buffer(
          ST_GeomFromText('POINT(" . $origin_latitude . " " . $origin_longitude . ")', 4326), (.01*valid_distance)) , location)"),
                1)
                ->orwhere(DB::raw("ST_Contains(ST_Buffer(
          ST_GeomFromText('POINT(" . $destination_latitude . " " . $destination_longitude . ")', 4326), (.01*valid_distance)) , location)"),
                  1);
          })
          ->first();

        return $valid_coupon;
    }

    public static function getCouponByCouponCde($coupon_code)
    {
        return self::select('coupon_code', 'coupon_amount', 'event_id',
          'start_date', 'end_date', 'valid_distance')
          ->where('coupon_code', $coupon_code)
          ->first();
    }
}
