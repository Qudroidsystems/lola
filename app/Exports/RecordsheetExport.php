<?php

namespace App\Exports;

use App\Models\broadsheet;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\SubjectTeacher;
use App\Models\subjectclass;
use App\Models\student;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;


class RecordsheetExport implements FromView, ShouldAutoSize, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */



    public function view(): View
    {


        $current = "Current";
        $subjectclassid =  Session::get('subjectclassid');
         $staffid = Session::get('staffid');
        $termid = Session::get('termid');
        $sessionid = Session::get('sessionid');


        // echo $schoolclassid;
        $broadsheets = broadsheet::where('subjectclassid',$subjectclassid)
        ->where('broadsheet.staffid',$staffid)
        ->where('broadsheet.termid',$termid)
        ->where('broadsheet.session',$sessionid)
        ->leftJoin('subjectclass', 'subjectclass.id','=','broadsheet.subjectclassid')
        ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('users', 'users.id','=','subjectteacher.staffid')
        ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)
        ->leftJoin('studentRegistration', 'studentRegistration.id','=','broadsheet.studentId')
        ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
        ->get(['broadsheet.id as id','studentRegistration.admissionNO as admissionno','studentRegistration.firstname as fname','studentRegistration.lastname as lname',
        'subject.subject as subject','subject.subject_code as subjectcode','schoolclass.schoolclass as schoolclass','schoolclass.arm as arm',
        'schoolterm.term as term','schoolsession.session as session','subjectclass.id as subjectclid','broadsheet.staffid as staffid',
        'broadsheet.termid as termid','broadsheet.session as sessionid','users.id as staffid','schoolclass.id as schoolclassid','subjectclass.id as subjectclassid',
       'studentpicture.picture as picture','broadsheet.ca1 as ca1','broadsheet.ca2 as ca2','broadsheet.exam as exam','broadsheet.total  as total','broadsheet.grade as grade',
      'broadsheet.subjectpositionclass as position','broadsheet.remark as remark'])->sortBy('admissionno');






        return view('exports.studentscoresheet')->with('broadsheets',$broadsheets);

      }

      public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
        $sheet->getStyle('F1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
        $sheet->getStyle('H1')->getFont()->setBold(true);
        $sheet->getProtection()->setPassword('password');
        $sheet->getProtection()->setSheet(true);


        //$sheet->getStyle('*.E1')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        //$sheet->getStyle('*.F1')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $current = "Current";
        $subjectclassid =  Session::get('subjectclassid');
         $staffid = Session::get('staffid');
        $termid = Session::get('termid');
        $sessionid = Session::get('sessionid');

        $broadsheetscount = broadsheet::where('subjectclassid',$subjectclassid)
        ->where('broadsheet.staffid',$staffid)
        ->where('broadsheet.termid',$termid)
        ->where('broadsheet.session',$sessionid)
        ->leftJoin('subjectclass', 'subjectclass.id','=','broadsheet.subjectclassid')
        ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)->count();
        $broadsheetscount=  $broadsheetscount + 2;
        $sheet->getColumnDimension('G')->setVisible(false);
        $sheet->getColumnDimension('H')->setVisible(false);
        $sheet->getColumnDimension('I')->setVisible(false);
        $sheet->getColumnDimension('J')->setVisible(false);
        $sheet->getColumnDimension('K')->setVisible(false);

        $sheet->getColumnDimension('G')->setWidth(0);
        $sheet->getColumnDimension('H')->setWidth(0);
        $sheet->getColumnDimension('I')->setWidth(0);
        $sheet->getColumnDimension('J')->setWidth(0);
        $sheet->getColumnDimension('K')->setWidth(0);

       for($i = 2; $i < $broadsheetscount; $i++){
        $sheet->getStyle('D'.$i.':'.'F'.$i)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

       }




    }



    public function registerEvents(): array

    {

        return [

            AfterSheet::class    => function(AfterSheet $event) {



                $event->sheet->getDelegate()->freezePane('A1');



            },

        ];

    }

}
