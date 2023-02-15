<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Vars\Roles;
class UserImportByCollection implements ToCollection,WithValidation, WithStartRow,SkipsOnError
{
    use Importable,SkipsErrors;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $request = request();

        // dd($collection);

        foreach ($collection as $row)
        {
            try {
                // $data = "buyer";
                $user = User::create([
                    'name'            => $row[0],
                    'email'                 => $row[1],
                    'phone'                 => $row[2],
                    'password'              => Hash::make($row[3]),
                    'address line 1'        => $row[4],
                    'address line 2'        => $row[5],
                ]);
                 $user->syncRoles([Roles::CUSTOMER]);
                // $user->info()->create([
                //     'dob'       => now()->parse($data)->format('Y-m-d'),
                //     'country'   => $row[5],
                // ]);
                // $user->syncRoles([User::CUSTOMER]);
                
                // if( isset($row[6]) && isset($row[7]) ) {
                //     if( $plan = \App\Models\Plan::find(intval($row[6])) ) {

                //         $request->merge([
                //             'plan_id' => $plan->id,
                //             'plan_duration_id' => trim($row[7])
                //         ]);
        
                //         // subscribe this user to this plan
                //         app(\App\Http\Controllers\Admin\UserController::class)
                //             ->subscribeToPlan($user, $request);

                //         // send mail to customer
                //         \App\Vars\SystemMails::customer_new_registration(
                //             $user, $plan->title
                //         );
                //     }
                // }

            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
        // $data = date('Y-m-d',strtotime($row[3]));
        // $user =  new User([
        //     'first_name'            => $row[0],
        //     'email'                 => $row[1],
        //     'phone'                 => $row[2],
        //     'dob'                   => $data, 
        //     'password'              => Hash::make($row[4]),
        //     'country'               => $row[5],
        //     'refer_code'            => $this->getReferralCode($row[0]),
        // ]);
        
       
        // return $user;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => ['required','unique:users,email'],
            '2' => ['required','unique:users,phone'],
        ];
    }
    public function customValidationAttributes()
    {
        return [
            '1' => 'email',
            '2' => 'phone',
        ];
    }
    public function onError(\Throwable $e)
    {
        dd($e->getMessage());
        // Handle the exception how you'd like.
    }
    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Duplicate email used in file',
            '2.unique' => 'Duplicate phone used in file',
        ];
    }

    public function getReferralCode($name){
        $subPart = substr($name,0,4).$this->randStr(4);

        if(User::where('refer_code','LIKE','%'.$subPart.'%')->exists()){
            $subPart =  $this->getReferralCode($name);
        }
        return strtoupper($subPart);
    }

    // This function will return a random
    // string of specified length
    public function randStr($no_of_char)
    {
    
        // String of all alphanumeric character
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str),0, $no_of_char);
    }
}
