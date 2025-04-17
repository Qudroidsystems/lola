<?php

use App\Http\Controllers\AcademicinfoController;
use App\Http\Controllers\AcademicOperationsController;
use App\Http\Controllers\AjaxarmController;
use App\Http\Controllers\AjaxclassController;
use App\Http\Controllers\AjaxclasssettingsController;
use App\Http\Controllers\AjaxclassteacherController;
use App\Http\Controllers\AjaxschoolhouseController;
use App\Http\Controllers\AjaxsessionController;
use App\Http\Controllers\AjaxStudentDeleteController;
use App\Http\Controllers\AjaxSubclassController;
use App\Http\Controllers\AjaxSubController;
use App\Http\Controllers\AjaxsubjectController;
use App\Http\Controllers\AjaxsubjectopController;
use App\Http\Controllers\AjaxsubteacherController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ClasscategoryController;
use App\Http\Controllers\ClassOperationController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\MyClassController;
use App\Http\Controllers\MyresultroomController;
use App\Http\Controllers\MyScoreSheetController;
use App\Http\Controllers\MySubjectController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolArmController;
use App\Http\Controllers\SchoolBillController;
use App\Http\Controllers\SchoolBillTermSessionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolHouseController;
use App\Http\Controllers\SchoolPaymentController;
use App\Http\Controllers\SchoolsessionController;
use App\Http\Controllers\SchooltermController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffImageUploadController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentHouseController;
use App\Http\Controllers\StudentImageUploadController;
use App\Http\Controllers\StudentpersonalityprofileController;
use App\Http\Controllers\StudentResultsController;
use App\Http\Controllers\SubjectClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectOperationController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewStudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('website.home');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('biodata', BiodataController::class);
    Route::get('/overview/{id}', [OverviewController::class, 'show'])->name('user.overview');
    Route::get('/settings/{id}', [BiodataController::class, 'show'])->name('user.settings');
    Route::post('ajaxemailupdate', [BiodataController::class, 'ajaxemailupdate']);
    Route::post('ajaxpasswordupdate', [BiodataController::class, 'ajaxpasswordupdate']);
    Route::resource('permissions', PermissionController::class);
    Route::get('/adduser/{id}', [RoleController::class, 'adduser'])->name('roles.adduser');
    Route::get('/updateuserrole', [RoleController::class, 'updateuserrole'])->name('roles.updateuserrole');
    Route::get('/userid/{userid}/roleid/{roleid}', [RoleController::class, 'removeuserrole'])->name('roles.removeuserrole');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('academicoperations', AcademicOperationsController::class);

    Route::resource('subject', SubjectController::class);
    Route::get('/subjectid/{subjectid}', [SubjectController::class, 'deletesubject'])->name('subject.deletesubject');
    Route::post('subjectid', [SubjectController::class, 'updatesubject'])->name('subject.updatesubject');

    Route::resource('schoolclass', SchoolClassController::class);

    Route::resource('schoolarm', SchoolArmController::class);
    Route::get('/schoolclassid/{schoolclassid}', [SchoolClassController::class, 'deleteschoolclass'])->name('schoolclass.deleteschoolclass');
    Route::post('schoolclassid', [SchoolClassController::class, 'updateschoolclass'])->name('schoolclass.updateschoolclass');

    Route::get('/armid/{armid}', [SchoolArmController::class, 'deletearm'])->name('schoolarm.deletearm');
    Route::post('armid', [SchoolArmController::class, 'updatearm'])->name('schoolarm.updatearm');

    Route::resource('subjectclass', SubjectclassController::class);
    Route::get('/subjectclassid/{subjectclassid}', [SubjectClassController::class, 'deletesubjectclass'])->name('subjectclass.deletesubjectclass');

    Route::resource('staff', StaffController::class);

    Route::resource('staffacademicinfo', AcademicinfoController::class);

    Route::resource('subjectteacher', SubjectTeacherController::class);
    Route::get('/subjectteacherid/{subjectteacherid}', [SubjectTeacherController::class, 'deletesubjectteacher'])->name('subjectteacher.deletesubjectteacher');
    Route::post('subjectteacherid', [SubjectTeacherController::class, 'updatesubjectteacher'])->name('subjectteacher.updatesubjectteacher');

    Route::resource('classteacher', ClassTeacherController::class);
    Route::get('/classteacherid/{classteacherid}', [ClassTeacherController::class, 'deleteclassteacher'])->name('classteacher.deleteclassteacher');
    Route::post('classteacherid', [ClassTeacherController::class, 'updateclassteacher'])->name('classteacher.updateclassteacher');

    Route::resource('session', SchoolsessionController::class);
    Route::get('/sessionid/{sessionid}', [SchoolsessionController::class, 'deletesession'])->name('session.deletesession');
    Route::post('updatesessionid', [SchoolsessionController::class, 'updatesession'])->name('session.updatesession');

    Route::resource('term', SchooltermController::class);
    Route::post('updatetermid', [SchooltermController::class, 'updateterm'])->name('term.updateterm');
    Route::get('/termid/{termid}', [SchooltermController::class, 'deleteterm'])->name('term.deleteterm');

    Route::resource('student', StudentController::class);
    Route::get('/studentid/{studentid}', [StudentController::class, 'deletestudent'])->name('student.deletestudent');
    Route::get('/studentoverview/{id}', [StudentController::class, 'overview'])->name('student.overview');
    Route::get('/studentsettings/{id}', [StudentController::class, 'setting'])->name('student.settings');
    Route::get('/studentbulkupload', [StudentController::class, 'bulkupload'])->name('student.bulkupload');
    Route::post('/studentbulkuploadsave', [StudentController::class, 'bulkuploadsave'])->name('student.bulkuploadsave');
    Route::get('/batchindex', [StudentController::class, 'batchindex'])->name('student.batchindex');
    Route::get('/studentbatchid/{studentbatchid}', [StudentController::class, 'deletestudentbatch'])->name('student.deletestudentbatch');

    Route::resource('classoperation', ClassOperationController::class);

    Route::resource('classcategories', ClasscategoryController::class);
    Route::get('/classcategoryid/{classcategoryid}', [ClasscategoryController::class, 'deleteclasscategory'])->name('classcategories.deleteclasscategory');
    Route::post('updateclasscategoryid', [ClasscategoryController::class, 'updateclasscategory'])->name('classcategories.updateclasscategory');

    Route::resource('subjectoperation', SubjectOperationController::class);
    Route::resource('parent', ParentController::class);
    Route::resource('studentImageUpload', StudentImageUploadController::class);
    Route::resource('myclass', MyClassController::class);
    Route::resource('mysubject', MySubjectController::class);
    Route::resource('myresultroom', MyresultroomController::class);
    Route::resource('studentresults', StudentResultsController::class);
    Route::resource('subjectscoresheet', MyScoreSheetController::class);
    Route::resource('schoolhouse', SchoolHouseController::class);

    //schoolbill routes...
    Route::resource('schoolbill', SchoolBillController::class);
    Route::get('/billid/{billid}', [SchoolBillController::class, 'deletebill'])->name('schoolbill.deletebill');
    Route::post('billid', [SchoolBillController::class, 'updatebill'])->name('schoolbill.updateschoolbill');

    //schoolbill term session routes...
    Route::resource('schoolbilltermsession', SchoolBillTermSessionController::class);
    Route::get('/schoolbilltermsessionid/{schoolbilltermsessionid}', [SchoolBillTermSessionController::class, 'deleteschoolbilltermsession'])->name('schoolbilltermsession.deleteschoolbilltermsession');
    Route::post('schoolbilltermsessionbid', [SchoolBillTermSessionController::class, 'updateschoolbilltermsession'])->name('schoolbilltermsession.updateschoolbilltermsession');

    //schoolpayment routes....
    Route::resource('schoolpayment', SchoolPaymentController::class);
    Route::get('/studentinvoice/{studentid}/{schoolclassid}/{termid}/{sessionid}', [SchoolPaymentController::class, 'invoice'])->name('schoolpayment.invoice');
    Route::get('/deletestudentpayment/{paymentid}/', [SchoolPaymentController::class, 'deletestudentpayment'])->name('schoolpayment.deletestudentpayment');

    //analysis...
    Route::resource('analysis', AnalysisController::class);
    Route::post('analysisClassTermSession', [AnalysisController::class, 'analysisClassTermSession'])->name('analysis.analysisClassTermSession');

    //house routes
    Route::post('houseid', [SchoolHouseController::class, 'updatehouse'])->name('schoolhouse.updatehouse');
    Route::get('/houseid/{houseid}', [SchoolHouseControll::class, 'deleteherouse'])->name('schoolhouse.deletehouse');
    Route::resource('studenthouse', StudentHouseController::class);

    //Route::resource('studentpersonalityprofile',StudentpersonalityprofileController::class);
    Route::get('/viewstudent/{id}/{termid}/{sessionid}', [ViewStudentController::class, 'show'])->name('viewstudent');
    Route::get('/subjectscoresheet/{schoolclassid}/{subjectclassid}/{staffid}/{termid}/{sessionid}', [MyScoreSheetController::class, 'subjectscoresheet'])->name('subjectscoresheet');
    //Route::resource('viewstudent', viewStudentController::class);
    Route::resource('subjectoperation', SubjectOperationController::class);
    Route::get('/subjectinfo/{id}/{schid}/{sessid}/{termid}', [SubjectOperationController::class, 'subjectinfo'])->name('subjectoperation.subjectinfo');
    Route::get('/viewresults/{id}/{schoolclassid}/{sessid}/{termid}', [StudentResultsController::class, 'viewresults']);
    Route::get('/studentpersonalityprofile/{id}/{schoolclassid}/{sessid}/{termid}', [StudentpersonalityprofileController::class, 'studentpersonalityprofile'])->name('myclass.studentpersonalityprofile');
    Route::post('save', [StudentpersonalityprofileController::class, 'save'])->name('save');
    Route::get('export', [MyScoreSheetController::class, 'export']);
    Route::post('classsetting', [MyScoreSheetController::class, 'importsheet'])->name('import.post');
    Route::post('importsheet', [MyScoreSheetController::class, 'importsheet'])->name('import.post.sheet');
    Route::get('/importform/{schoolclassid}/{subjectclassid}/{staffid}/{termid}/{sessionid}', [MyScoreSheetController::class, 'importform']);

    Route::delete('/ajaxsub/{id}', [AjaxSubController::class, 'delete']);
    Route::delete('/ajaxsubclass/{id}', [AjaxSubclassController::class, 'delete']);
    Route::delete('/ajaxclassteacher/{id}', [AjaxclassteacherController::class, 'delete']);
    Route::delete('/ajaxclass/{id}', [AjaxclassController::class, 'delete']);
    Route::delete('/ajaxarm/{id}', [AjaxarmController::class, 'delete']);
    Route::delete('/ajaxsession/{id}', [AjaxsessionController::class, 'delete']);
    Route::delete('/ajaxsubteacher/{id}', [AjaxsubteacherController::class, 'delete']);
    Route::delete('/ajaxsubject/{id}', [AjaxsubjectController::class, 'delete']);
    // Route::delete('/ajaxsubjectop/{id}', [AjaxsubjectopController::class, 'delete']);
    Route::delete('/ajaxstudentdelete/{id}', [AjaxStudentDeleteController::class, 'delete']);
    Route::delete('/ajaxschoolhousedelete/{id}', [AjaxschoolhouseController::class, 'delete']);
    Route::delete('/ajaxclasssettings/{id}', [AjaxclasssettingsController::class, 'delete']);
    Route::get('image-upload', [StaffImageUploadController::class, 'imageUpload'])->name('image.upload');
    Route::post('image-upload', [StaffImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');

});
