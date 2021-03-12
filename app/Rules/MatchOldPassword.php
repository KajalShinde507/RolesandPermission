<?php

namespace App\Rules;
use Auth;
use App\User;
use App\VerifyUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $email;
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute,$value)
    {    
        

       //dd($this->email->email);
    
       $user=User::where('email',$this->email->email)->where('password',MD5($value))->first();
       
       //$data=MD5($value);
        //dd($user);
        
          if(empty($user))
          {
             return false;
            }
          else
          {
             return  true;
          }
       

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       
        return 'Old password mismatch';
    }
}
