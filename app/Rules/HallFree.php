<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\HallBooking;
use Carbon\Carbon;

class HallFree implements Rule,  DataAwareRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $id = array_key_exists('id', $this->data) ? $this->data['id'] : 0;
        $date = Carbon::parse($this->data['date'])->format('Y-m-d');
        $from = Carbon::parse($this->data['from'])->format('H:i:s');
        $to = Carbon::parse($this->data['to'])->format('H:i:s');

        $count = HallBooking::where('id', '!=', $id)
            ->where('hall_id', $this->data['hall_id'])
            ->whereDate('date', $date)
            ->whereTime('from', '<', $to)
            ->whereTime('to', '>', $from)
            ->count();
        return $count == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The hall is not availble at this time.';
    }

    public function setData($data)
    {
        $this->data = $data['data'];
        return $this;
    }
}
