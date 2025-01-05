<?php

namespace App\Http\Livewire;

use App\Mail\ForgetPassword as MailForgetPassword;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ForgetPassword extends Component
{

    public $step=1, $email, $verification_code, $new_password, $confirm_password;

    public function render()
    {
        return view('livewire.forget-password');
    }


    public function submit()
    {
        if($this->step == 1)
        {
            $this->resetErrorBag();
            $validator = Validator::make(
                [ 'email' => $this->email ],
                [ 'email'=> 'required|email|exists:users,nodal_person_email' ]
            );
            $validator->validate();

            try {
                $verification_code = mt_rand(100000, 999999);
                User::where('nodal_person_email', $this->email)->update(['verification_code'=> $verification_code]);

                Mail::to($this->email)->send(new MailForgetPassword($verification_code));
            } catch (\Exception $e) {
                Log::debug($e->getMessage());
            }

            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'आम्ही तुमच्या मेल आयडीवर पडताळणी कोड पाठवला आहे, कृपया येथे कोड टाइप करा.']);
            $this->step++;
        }
        elseif($this->step == 2)
        {
            $this->resetErrorBag();
            // $this->validate([
            //     'verification_code'=> 'required|digits:6',
            // ]);
            $validator = Validator::make(
                [ 'verification_code' => $this->verification_code ],
                [ 'verification_code'=> 'required|digits:6' ]
            );
            $validator->validate();

            $isValidCode = User::where(['nodal_person_email' => $this->email, 'verification_code' => $this->verification_code])->first();
            if($isValidCode)
            {
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'ईमेल यशस्वीरित्या सत्यापित केले, नवीन पासवर्ड टाइप करा.']);
                $this->step++;
            }
            else
            {
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'danger', 'text' => 'प्रविष्ट केलेला सत्यापन कोड अवैध आहे कृपया पुन्हा प्रयत्न करा.']);
            }
        }
        elseif($this->step == 3)
        {
            $this->resetErrorBag();
            // $this->validate([
            //     'new_password'=> 'required|max:25',
            //     'confirm_password'=> 'required|same:new_password',
            // ]);
            $validator = Validator::make(
                [ 'new_password' => $this->new_password, 'confirm_password' => $this->confirm_password ],
                [ 'new_password'=> 'required|max:25', 'confirm_password'=> 'required|same:new_password' ]
            );
            $validator->validate();

            try{
                $isUpdated = User::where(['nodal_person_email' => $this->email, 'verification_code' => $this->verification_code])
                                ->update(['password'=> Hash::make($this->new_password)]);

                if($isUpdated)
                {
                    $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'पासवर्ड यशस्वीरित्या अपडेट केला.']);
                    return redirect()->route('login')->with('success_message', 'पासवर्ड यशस्वीरित्या अपडेट केला');
                }
                else
                {
                    $this->dispatchBrowserEvent('swal:modal', ['type' => 'danger', 'text' => 'पासवर्ड अपडेट करताना काहीतरी चूक झाली, कृपया पुन्हा प्रयत्न करा.']);
                }
            }
            catch(Exception $e)
            {
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'danger', 'text' => 'पासवर्ड अपडेट करताना काहीतरी चूक झाली, कृपया पुन्हा प्रयत्न करा.']);
            }
        }
    }
}
