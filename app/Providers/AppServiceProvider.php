<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * The valadator is to be used with the task_time field only.  This functions
         * requires 3 parameters with an optional 4th parameter within a validation
         * rule.  It will check if an appointment exists with a time and date for
         * a user.  If a user is updating an appointment, then appointment id is needed
         * to filter out it's own record.
         *
         * @param $value is the value of the task_time
         * @param $parameter[0] is the task_date
         * @param $parameter[1] is the user_id
         * @param $parameter[2] is the optional appointment id
         *
         * @return boolean - return whether validation passes (true) or fails (false)
         */
        Validator::extend('uniqueTaskDateAndTime', function ($attribute, $value, $parameters, $validator) {
            $query = DB::table('appointments')->where('task_time', $value)
                                              ->where('task_date', $parameters[0])
                                              ->where('user_id', $parameters[1]);

            if(isset($parameters[2])) {
                $query->where('id', '!=', $parameters[2]);
            }
            $count = $query->count();

            return $count == 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
