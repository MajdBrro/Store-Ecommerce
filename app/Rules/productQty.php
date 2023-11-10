<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class productQty implements Rule
{

    private $manageStock;

    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($manage_stock)
    {
        $this -> manageStock == $manage_stock;
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
        if($this->manageStock==1 && $value==null)
        return false;
        else 
        return true;

        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'عليك إدخال الكمية ';
    }
}
