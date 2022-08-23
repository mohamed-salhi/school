<?php

namespace App\Jobs;

use App\Models\My_parent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class SendEmailJop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $Email;
public $Password;
public $Name_Father;
public $Name_Father_en;
public $National_ID_Father;
public $Passport_ID_Father;
public $Phone_Father;
public $Job_Father;
public $Job_Father_en;
public $Nationality_Father_id;
public $Blood_Type_Father_id;
public $Address_Father;
public $Religion_Father_id;


    public function __construct(  $Email,  $Password,
               $Name_Father,   $Name_Father_en,
               $National_ID_Father,  $Passport_ID_Father,
               $Phone_Father,  $Job_Father,  $Job_Father_en,
               $Nationality_Father_id,  $Blood_Type_Father_id,
               $Address_Father,  $Religion_Father_id)
    {
        $this->Email=$Email;
        $this->Password=$Password;
        $this->Name_Father=$Name_Father;
        $this->Name_Father_en=$Name_Father_en;
        $this->National_ID_Father=$National_ID_Father;
        $this-> Passport_ID_Father=$Passport_ID_Father;
        $this->Phone_Father=$Phone_Father;
        $this->Job_Father=$Job_Father;
        $this->Job_Father_en=$Job_Father_en;
        $this->Nationality_Father_id=$Nationality_Father_id;
        $this-> Blood_Type_Father_id=$Blood_Type_Father_id;
        $this->Address_Father=$Address_Father;
        $this->Religion_Father_id=$Religion_Father_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        My_parent::create(
            [
                'Email' =>    $this->Email,
                'Password' => Hash::make( $this->Password),
                'Name_Father' => ['en' =>  $this->Name_Father, 'ar' =>  $this->Name_Father],
                'Job_Father' => ['en' =>   $this->National_ID_Father, 'ar' =>    $this-> Passport_ID_Father],
                'National_ID_Father' =>   $this->Phone_Father,
                'Passport_ID_Father' =>   $this->Job_Father,
                'Phone_Father' =>   $this->Job_Father_en,
                'Nationality_Father_id' =>  $this->Nationality_Father_id,
                'Blood_Type_Father_id' =>  $this-> Blood_Type_Father_id,
                'Religion_Father_id' =>  $this->Address_Father,
                'Address_Father' =>  $this->Religion_Father_id,

            ]
        );
    }
}
