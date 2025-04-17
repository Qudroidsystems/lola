<?php

namespace App\Imports;


use App\Models\Student;
use App\Models\Schoolterm;
use App\Models\Schoolclass;
use App\Models\Studentclass;
use App\Models\Studenthouse;
use App\Models\Schoolsession;
use App\Models\Studentpicture;
use App\Models\Promotionstatus;
use Illuminate\Validation\Rule;
use App\Models\StudentBatchModel;
use App\Models\ParentRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Studentpersonalityprofile;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

class StudentsImport implements ToModel, WithUpserts, WithUpsertColumns, WithStartRow, WithValidation,
WithProgressBar
{

    use Importable;


       public $id=0;
       public $_sclassid=0;
       public $_teremid=0;
       public $_sessionid=0;
       public $_batchid=0;





    public function model(array $row)
    {
        $current = "Current";
        $schoolclassid =  Session::get('sclassid');
        $termid = Session::get('tid');
        $sessionid = Session::get('sid');
        $batchid = Session::get('batchid');

        $admissionno = $row[0];
        $surname = $row[1];
        $othername = $row[2];
        $gender = $row[3];
        $homeaddress = $row[4];
        $dob = $row[5];
        $age = $row[6];
        $placeofbirth = $row[7];
        $nationality = $row[8];
        $state = $row[9];
        $local = $row[10];
        $religion = $row[11];
        $lastschool = $row[12];
        $lastclass = $row[13];


        $studentbiodata = new Student();
        $studentclass = new Studentclass();
        $promotion = new Promotionstatus();
        $parent = new ParentRegistration();
        $studenthouse = new Studenthouse();
        $picture = new Studentpicture();
        $studentpersonalityprofile = new Studentpersonalityprofile();

        //populating student biodata
        $studentbiodata->admissionNo = $admissionno;
        $studentbiodata->tittle ="";
        $studentbiodata->firstname = $othername;
        $studentbiodata->lastname = $surname;
        $studentbiodata->othername = "";
        $studentbiodata->gender = $gender;
        $studentbiodata->home_address = "$homeaddress";
        $studentbiodata->home_address2 = "";
        $studentbiodata->dateofbirth = $dob;
        $studentbiodata->age = $age;
        $studentbiodata->placeofbirth = $placeofbirth;
        $studentbiodata->religion = $religion;
        $studentbiodata->nationlity = $nationality;
        $studentbiodata->state = $state;
        $studentbiodata->local = "$local";
        $studentbiodata->last_school = $lastschool;
        $studentbiodata->last_class = $lastclass;
        $studentbiodata->registeredBy= Auth::user()->id;
        $studentbiodata->batchid = $batchid;
        $studentbiodata->save();
        $studentId = $studentbiodata->id;



        // student parent

        $parent->studentId = $studentId;
        $parent->father_title ="";
        $parent->mother_title ="";
        $parent->father  ="";
        $parent->mother ="";
        $parent->father_phone ="";
        $parent->mother_phone ="";
        $parent->parent_address ="";
        $parent->office_address ="";
        $parent->father_occupation ="";
        $parent->religion ="";
        $parent->save();


        //for student picture...
        $picture->studentid = $studentId;
        $picture->save();


        //registering school class and arm for the student
        $studentclass->studentId = $studentId;
        $studentclass->schoolclassid = $schoolclassid;
        $studentclass->termid = $termid;
        $studentclass->sessionid = $sessionid;
        $studentclass->save();

         //for class history...
         $promotion->studentId = $studentId;
         $promotion->schoolclassid = $schoolclassid;
         $promotion->termid = $termid;
         $promotion->sessionid = $sessionid;
         $promotion->promotionStatus = "PROMOTED";
         $promotion->classstatus = "CURRENT";
         $promotion->save();

          //for student house...
          $studenthouse->studentid = $studentId;
          $studenthouse->termid = $termid;
          $studenthouse->sessionid = $sessionid;
          $studenthouse->save();

          //for student personality profile...
          $studentpersonalityprofile->studentid = $studentId;
          $studentpersonalityprofile->schoolclassid = $schoolclassid;
          $studentpersonalityprofile->termid = $termid;
          $studentpersonalityprofile->sessionid = $sessionid;
          $studentpersonalityprofile->save();

      //return $this->studentsimportsheet($schoolclassid,$termid,$sessionid);

    }



    public function rules(): array
    {
        global $_sclassid;
        global $_termid;
        global $_sessionid;
        global $_batchid;

        $_sclassid =  Session::get('sclassid');
        $_termid = Session::get('tid');
        $_sessionid = Session::get('sid');
        $_batchid = Session::get('batchid');


        return [

            '14'=> function($attribute, $value,$onFailure) use(&$_sclassid) {
                if($value != $_sclassid){
                   $onFailure('This data does not match the selected School Class');
                }
                },

            '15'=> function($attribute, $value,$onFailure) use(&$_termid) {
                    if($value != $_termid){
                    $onFailure('This data does not match the selected School Term');
                    }
                },

            '16'=> function($attribute, $value,$onFailure) use(&$_sessionid) {
                    if($value != $_sessionid){
                    $onFailure('This data does not match the selected School Session');
                    }
                },

        ];
    }
    public function customValidationMessages()
    {
        return [
            '14.in' => 'Custom message for :attribute.',
            '15.in' => 'Custom message for :attribute.',
            '16.in' => 'Custom message for :attribute.',

        ];
    }

    public function customValidationAttributes()
    {
        return [
            '14' =>  'schoolclassid',
            '15' =>  'termid',
            '16' =>  'sessionsid',
            ];
    }
    public function startRow(): int
    {
        return 2;
    }

    public function uniqueBy()
    {
        return 'id';
    }

    public function upsertColumns()
    {
        return ['ca1', 'ca2','exam'];
    }

    public function onFailure(Failure $failure){

    }

    // public function onError(\Throwable $e)
    // {
    //     // Handle the exception how you'd like.
    //     StudentBatchModel::where("id",Session::get('batchid'))->update(["Status" => "Failed"]);
    // }


}
