# About Event Coupons

This is a application to create coupons for events.

# Getting started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes

# Prerequisites

Before you start please make sure that you have the following packages installed on your machine:
Composer, PHP 7, MySQL

# Setting up Laravel part

* Clone the repo
* Give full permission to the storage and bootstrap/cache folders in the codebase.
* Create `.env` file (can be based on `.env.example`)
* Define ENV variables in .env file

Install Dependencies using Composer
````
composer install
````
Use the following command to generate a random 32 character application key.
````
php artisan key:generate
````
Install Database Structure Using Artisan:
````
php artisan migrate
````
followed by seed command if you want dummy data for events
````
php artisan db:seed --class=EventSeeder
````
to populate master data.
Install passport using command
````
php artisan passport:install
php artisan passport:client --personal

````
Setup virtual host or make the application running by
```
php artisan serve
```
Modify resources/assets/src/environments/environment.ts with your application URL(**default will be http://localhost:8000**)

**Note**
For any Class not found error, please execute `composer dump-autoload`


#Api Details
##Auth
**Registration**
```
Endpoint: api/register

Request: 
name:Admin
email:admin@admin.com
password:Admin@Test

Response:
{
    "response": {
        "status": "success",
        "message": "User Registered Successfully",
        "data": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDBmZjVjNDVkMDA2MDlhNDQ5ZDQ0MmMyYjhkZTJkNWI3Yjc5Y2ZkYTdhNzA5NjI1ZGVhYjMyY2I2M2Y2YjQ3YjZhNzdmZjUxNmNmMTMyMmQiLCJpYXQiOjE2MDYzODQ0ODUsIm5iZiI6MTYwNjM4NDQ4NSwiZXhwIjoxNjM3OTIwNDg1LCJzdWIiOiIxNSIsInNjb3BlcyI6W119.mihgQy2v6L1rQ_Ny6aKcDqDVoiN8EWPdhCIlW3LAKro0A864zIeRDh8xuVXIlaDVJi3YQQhNZCf60E7kV-hk91F736AFvYI9eH3ervqNo93i4DhED42rx5pW0WDn-pZH18tP7Xi8SilQobnb3k4RA1lTCiRxL0mUjcnykE5giVUXS9ZtZV8jIoRyIByzxdgH93B6d3D60TdLoSL7G08jEPsvCeNS_SsXiAbIg7dOvNRsjOxUGQSJG2smdpTV8DcOcIukDr3NN5b2_7lxeOBPtIWTpfDsMmUVreC1vFco8GplFosFOqKOtP0uDZ8pLRbVgmTEFebGIfDZgZtDA9faTK0uuWIqbqq_byngCWHrmI-n1bM17k8uTIuzJ7hYcckopYTfRNuxM7bfkvWs0l5en0qKq1oLLhFjEXUqyyHIy2QOb5rrIhYj667kaQgNjzuue-IqIDDh6pgm1mxU8myCgSgsyJTgfYSxxR7t0Lr0vn8-RC5O-Jno2KCKc1_R3pjsZxhE0XbyQA2PjL8yL7K2Xwlf-8tKc17mJ4ttZ8cuEYh6zYAhAwqyxMPvGg1GiZ_wSozetx1oWqRPE3Imis0L23CW75E8sXyMnV6aFDH4ltO60tO1HObfOPqgwWHosVPAoUFHZCZdQ39eUvVnGA6pn1TfsbUwi6riVf06ERP-hYw"
        }
    }
}
```
**Login**
```
Endpoint: api/login

Request: 
email:admin@admin.com
password:Admin@Test

Response:
{
    "response": {
        "status": "success",
        "message": "User Logged In Successfully",
        "data": {
            "data": {
                "email": "admin@admin.com",
                "password": "Admin@Test",
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjcwMDE4NGI2NDRiYTQ0NGFiZmJiNWJkNTE0NWU1MTUxNjYwYjAxNDIyMTBlOGUwNDEzNzM0ZGIyZjdlYWFiYjkyMjc2OTM4Y2NjYTA3ODkiLCJpYXQiOjE2MDYzODQ1MjQsIm5iZiI6MTYwNjM4NDUyNCwiZXhwIjoxNjM3OTIwNTI0LCJzdWIiOiIxNCIsInNjb3BlcyI6W119.k7_bSSL0UD-A8K34KFXrMYNw5lYIwnW66r2sfkuP0mCkRLfP5jGtDXEAg7AFudgG8LB3br_5I5-sUw8WEMH_SMOZttd-g4lh6uz_L7uSFCjckyc0C2X1tXc_el0KbSKXUASwi9115rz6SL08IVEQ0NtAt9hpGzCzv_APAl9KYd0kKElhGNw4dmMdLwMHwVQkmjciKh_sX6YjV60hZFgYOycnXfsQr1yHx209DjS1oRWkfyz35Kai--TO96c6hLb4LNyP3GPMvZfItwxwiMRW8Hcwls3KH0X7SEecm-eDFtN3lqTsNTjlbtGQdsEB4ynJVJ9eamNZ06KsP3qq_rpP5BawhTy1JzErqCvofS4KEDic2JUz0aRYm3Tof3FcRpZ54ZDFwSEPHyZVomuBA0Gyay_cyDOXK6QHpRMKMnJ9TpvP-if6W8Y4Vdt8DShJsbrQqZTj8hkrxc7AEW0DhrH9rOzy8Tg9cmRBMa22BnE-e_Fu7rrOvNwhO5TfYrmqCfPnxpYYoFrMRQF-zLMxN68hCRAuJdODtYQQ3sf3LaF2a7H9L6cLUOqqDBZ644l-KNWXiPfNhlPKzKw0zhcHNdaVwkDxZsujCIOnYpp8ab_bbniF2X8gPjXh9D_jBpEcFxfovWU7Mv4EWXW5qFYEicKUKfco7tXAYsJgNqpNBAHNLvY"
            }
        }
    }
}
```

##Events
You can list new events. Currently no API's for event creation. Can add them via seeder.
**All Events**
```
Endpoint: api/event/all
Response:
{
    "response": {
        "status": "success",
        "message": "Event List",
        "data": {
            "events": [
                {
                    "id": 1,
                    "event_name": "Sunburn Goa 2020",
                    "event_date": "2020-12-12",
                    "latitude": 15.806877,
                    "longitude": 73.712798
                },
                {
                    "id": 2,
                    "event_name": "Bhakti Camp",
                    "event_date": "2020-12-07",
                    "latitude": 15.543664,
                    "longitude": 73.762366
                }
            ]
        }
    }
}
```

##Coupons
Can add, activate, deactivate and list coupons.
**All Coupons**
```
Endpoint: api/coupon/all
Response:
{
    "response": {
        "status": "success",
        "message": "Coupon List",
        "data": {
            "coupons": [
                {
                    "coupon_code": "QWSDFQQ",
                    "coupon_amount": 100,
                    "event_id": 1,
                    "start_date": "2020-10-12",
                    "end_date": "2020-12-15",
                    "valid_distance": 30,
                    "is_active": 1
                }
            ]
        }
    }
}
```
**Active Coupons**
```
Endpoint: api/coupon/active
Response:
{
    "response": {
        "status": "success",
        "message": "Coupon List",
        "data": {
            "coupons": [
                {
                    "coupon_code": "QWSDF",
                    "coupon_amount": 100,
                    "event_id": 1,
                    "start_date": "2020-10-12",
                    "end_date": "2020-12-15",
                    "valid_distance": 30
                }
            ]
        }
    }
}
```
**Add Coupons**
```
Endpoint: api/coupon/add
Request: 
coupon_code:QERTW78
coupon_amount:100
event_id:2
start_date:2020-11-29
end_date:2020-12-29
valid_distance:20

*valid_distance in KM
Response:
{
    "response": {
        "status": "success",
        "message": "Coupon Code Added",
        "data": {
            "data": {
                "coupon_code": "QERTW78",
                "coupon_amount": "100",
                "event_id": "2",
                "start_date": "2020-11-29",
                "end_date": "2020-12-29",
                "valid_distance": "20",
                "updated_at": "2020-11-26T10:01:41.000000Z",
                "created_at": "2020-11-26T10:01:41.000000Z",
                "id": 2
            }
        }
    }
}
```
**Deactivate Coupons**
```
Endpoint: api/coupon/deactivate
Request: 
coupon_id: 1
Response:
{
    "response": {
        "status": "success",
        "message": "Coupon deactivated",
        "data": []
    }
}
```
**Activate Coupons**
```
Endpoint: api/coupon/activate
Request: 
coupon_id: 1
Response:
{
    "response": {
        "status": "success",
        "message": "Coupon activated",
        "data": []
    }
}
```
**Apply Coupons**
```
Endpoint: api/coupon/apply
Request: 
coupon_code:QWSDF
origin_latitude:5.806877
origin_longitude:73.712798
destination_latitude:15.999999
destination_longitude:73.712798
Response:
{
    "response": {
        "status": "success",
        "message": "Valid Coupon",
        "data": {
            "coupon_details": {
                "coupon_code": "QWSDF",
                "coupon_amount": 100,
                "event_id": 1,
                "start_date": "2020-10-12",
                "end_date": "2020-12-15",
                "valid_distance": 30
            },
            "encoded_polyline": "_dmb@_`|`M_ze}@?"
        }
    }
}
```
