<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'Default-role',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-updateuserrole',
           'role-romove-fromrole',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',


           'dashboard-list',
           'usermanagement-link',
           'staffmanagement-link',
           'basicsettingsmanagement-link',
           'apps-link',

           'class_operation-list',
           'class_operation-create',
           'class_operation-edit',
           'class_operation-delete',

           'myclass-list',
           'mysubject-list',

           'class_teacher-list',
           'class_teacher-create',
           'class_teacher-edit',
           'class_teacher-delete',

           'myresultroom-list',
           'myresultroom-creat',
           'myresultroom-edit',
           'myresultroom-delete',

           'parent-list',
           'parent-create',
           'parent-edit',
           'parent-delete',

           'school_arm-list',
           'school_arm-create',
           'school_arm-edit',
           'school_arm-delete',

           'school_class-list',
           'school_class-create',
           'school_class-edit',
           'school_class-delete',

           'session-list',
           'session-create',
           'session-edit',
           'session-delete',

           'term-list',
           'term-create',
           'term-edit',
           'term-delete',

           'staff-list',
           'staff-create',
           'staff-edit',
           'staff-delete',

           'student-list',
           'student-create',
           'student-edit',
           'student-delete',
           'student_edit-edit',
           'student_delete-delete',

           'student_bulk-upload',
           'student_bulk-uploadsave',

           'studentresults-list',

           'subject_class-list',
           'subject_class-assign',
           'subject_class-edit',
           'subject_class-delete',

           'subject_operation-list',
           'subject_operation-create',
           'subject_operation-edit',
           'subject_operation-delete',

           'subject-list',
           'subject-create',
           'subject-edit',
           'subject-delete',

           'subject_teacher-list',
           'subject_teacher-assign',
           'subject_teacher-edit',
           'subject_teacher-delete',

           'view_student-list',

           'academic_operations-list',

           'student_picture-upload',

           'schoolhouse-list',
           'schoolhouse-create',
           'schoolhouse-edit',
           'schoolhouse-delete',

           'classcategory-list',
           'classcategory-create',
           'classcategory-edit',
           'classcategory-delete',

           'studenthouse-create',
           'classsettings-create',
           'classsettings-delete',

        ];

        foreach ($permissions as $permission) {
            $str = $permission;
            $delimiter = '-';
            $words = explode($delimiter, $str);

            foreach ($words as $word) {
                if($word == "user")
                Permission::create(['name' => $permission,'title'=>"User Management"]);

                if($word == "role")
                Permission::create(['name' => $permission,'title'=>"Role Management"]);

                if($word == "permission")
                Permission::create(['name' => $permission,'title'=>"Permission Management"]);

                if($word == "dashboard")
                Permission::create(['name' => $permission,'title'=>"Dashboard Pages"]);

                if($word == "class_operation")
                Permission::create(['name' => $permission,'title'=>"Class Operation Management"]);


                if($word == "myclass")
                Permission::create(['name' => $permission,'title'=>"User Class Management"]);

                if($word == "mysubject")
                Permission::create(['name' => $permission,'title'=>"User Subject Management"]);

                if($word == "class_teacher")
                Permission::create(['name' => $permission,'title'=>"Class Teacher Management"]);

                if($word == "myresultroom")
                Permission::create(['name' => $permission,'title'=>"User Result Room Management"]);

                if($word == "parent")
                Permission::create(['name' => $permission,'title'=>"Parent Management"]);

                if($word == "school_arm")
                Permission::create(['name' => $permission,'title'=>"School Arm Management"]);

                if($word == "school_class")
                Permission::create(['name' => $permission,'title'=>"School ClassManagement"]);

                if($word == "session")
                Permission::create(['name' => $permission,'title'=>"School Session Management"]);

                if($word == "term")
                Permission::create(['name' => $permission,'title'=>"School Term Management "]);

                if($word == "student")
                Permission::create(['name' => $permission,'title'=>"Student Management"]);

                if($word == "studentresults")
                Permission::create(['name' => $permission,'title'=>"Student Results Management"]);

                if($word == "student_bulk")
                Permission::create(['name' => $permission,'title'=>"Student Management"]);


                if($word == "subject_class")
                Permission::create(['name' => $permission,'title'=>"Subject Class Management"]);

                if($word == "subject_operation")
                Permission::create(['name' => $permission,'title'=>"Subject Operations Management"]);

                if($word == "subject")
                Permission::create(['name' => $permission,'title'=>"Subject Management"]);

                if($word == "subject_teacher")
                Permission::create(['name' => $permission,'title'=>"Subject Teacher Management"]);

                if($word == "view_student")
                Permission::create(['name' => $permission,'title'=>"View Student Management "]);

                if($word == "academic_operations")
                Permission::create(['name' => $permission,'title'=>"Basic Settings Management Link"]);

                if($word == "student_picture")
                Permission::create(['name' => $permission,'title'=>"Student Picture Management"]);

                if($word == "schoolhouse")
                Permission::create(['name' => $permission,'title'=>"School House Management"]);

                if($word == "classcategory")
                Permission::create(['name' => $permission,'title'=>"Class Category Management"]);

                if($word == "studenthouse")
                Permission::create(['name' => $permission,'title'=>"Student house Management"]);

                if($word == "classsettings")
                Permission::create(['name' => $permission,'title'=>"Class Settings Management "]);

            }
            //  Permission::create(['name' => $permission]);
        }
    }
}
