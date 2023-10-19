<?php

namespace App\Rules;

use App\Models\AttributeTranslation;
use Illuminate\Contracts\Validation\Rule;

class UniqueAttributeName implements Rule
{

    // private $attributeName;
    private $attributeId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributeId)
    {
        // $this->attributeName = $attributeName;
        $this->attributeId = $attributeId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
#########################طريقتي وهي تؤدي نفس غرض الاستاذ وبخطوات أقل########################################################
$attribute = AttributeTranslation::where('name', $value)->where('attribute_id','!=',$this->attributeId) -> first();
if($attribute)
return false;
else
return true;
#########################طريقتي وهي تؤدي نفس غرض الاستاذ وبخطوات أقل########################################################
#########################طريقة الاستاذ ##################################################
// if($this -> attributeId) //edit form
//     $attribute = AttributeTranslation::where('name', $value)->where('attribute_id','!=',$this->attributeId) -> first();
        // else  //creation form
        //     $attribute = AttributeTranslation::where('name', $value)->first();

        // if ($attribute)
        //     return false;
        // else
        //     return true;
#########################طريقة الاستاذ ###################################################

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' this name already exists  before';
    }
}
