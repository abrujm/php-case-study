<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Rules\ValidCoupon;
use Illuminate\Http\Request;

class CouponController extends BaseApiController
{

    public function addCoupon(Request $request)
    {
        $this->validate($request, [
          'coupon_code' => [
            'required',
            'string',
            'unique:coupons',
            'min:5',
            'max:8',
          ],
          'coupon_amount' => ['required', 'numeric', 'min:1'],
          'event_id' => ['required', 'exists:events,id'],
          'start_date' => ['date_format:Y-m-d', 'required'],
          'end_date' => ['date_format:Y-m-d', 'required', 'after:start_date'],
          'valid_distance' => ['required', 'numeric', 'min:1'],
        ]);

        $input = $request->all();

        try {
            $data = Coupons::addCoupon($input);
            return $this->sendResponse(true, 200,
              "Coupon Code Added", ['data' => $data]);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }

    }

    public function getAllCoupons()
    {
        try {
            $coupons = Coupons::all('coupon_code', 'coupon_amount', 'event_id',
              'start_date', 'end_date', 'valid_distance', 'is_active');

            return $this->sendResponse(true, 200,
              "Coupon List", ['coupons' => $coupons]);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }

    public function getActiveCoupons()
    {
        try {
            $coupons = Coupons::getActiveCoupons();

            return $this->sendResponse(true, 200,
              "Coupon List", ['coupons' => $coupons]);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }

    public function activateCoupon(Request $request)
    {

        $this->validate($request, [
          'coupon_id' => ['required', 'exists:coupons,id'],
        ]);
        $input = $request->all();

        try {
            $message = Coupons::activateCoupon($input['coupon_id']);

            return $this->sendResponse(true, 200,
              $message);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }

    public function deactivateCoupon(Request $request)
    {
        $this->validate($request, [
          'coupon_id' => ['required', 'exists:coupons,id'],
        ]);
        $input = $request->all();

        try {
            $message = Coupons::deactivateCoupon($input['coupon_id']);

            return $this->sendResponse(true, 200,
              $message);
        } catch (\Exception $e) {
            dd($e);
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }

    public function applyCoupon(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
          'origin_latitude' => ['required', 'string'],
          'origin_longitude' => ['required', 'string'],
          'destination_latitude' => ['required', 'string'],
          'destination_longitude' => ['required', 'string'],
          'coupon_code' => [
            'required',
            'exists:coupons,coupon_code',
            new ValidCoupon($input['origin_latitude'] ?? "",
              $input['origin_longitude'] ?? "",
              $input['destination_latitude'] ?? "",
              $input['destination_longitude'] ?? ""),
          ],
        ]);

        try {
            $points = [
              [$input['origin_latitude'], $input['origin_longitude']],
              [$input['destination_latitude'], $input['destination_longitude']],
            ];

            $data['coupon_details'] = Coupons::getCouponByCouponCde($input['coupon_code']);
            $data['encoded_polyline'] = \Polyline::encode($points);

            return $this->sendResponse(true, 200,
              "Valid Coupon", $data);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }
}
