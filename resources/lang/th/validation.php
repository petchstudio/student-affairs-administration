<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'โปรดใส่รูปภาพ (jpeg, png, bmp, gif, หรือ svg)',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'รูปแบบไฟล์ไม่ถูกต้อง (อนุญาต: :values)',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'url'                  => 'The :attribute format is invalid.',
    'recaptcha'            => 'พิสูจน์ว่าคุณไม่ได้เป็นหุ่นยนต์ไม่ถูกต้อง',
    'student_id'           => 'รหัสนักศึกษาไม่ถูกต้อง',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    
    'custom' => [
        // Account
        'id-card'             => [
            'required'  => 'โปรดระบุหมายเลขบัตรประชาชน',
            'max'       => 'รูปแบบหมายเลขบัตรประชาชนไม่ถูกต้อง',
            'unique'    => 'หมายเลขบัตรประชาชนมีอยู่แล้วในระบบ',
        ],
        'sdu-id'             => [
            'required'  => 'โปรดระบุรหัสบุคลากร',
            'max'       => 'รูปแบบรหัสบุคลากรไม่ถูกต้อง',
            'unique'    => 'รหัสบุคลากรมีอยู่แล้วในระบบ',
        ],
        'email'             => [
            'required'  => 'โปรดระบุอีเมล',
            'email'     => 'รูปแบบอีเมลไม่ถูกต้อง',
            'max'       => 'อีเมลต้องไม่มีความยาวเกิน :max ตัวอักษร',
            'unique'    => 'อีเมลนี้มีอยู่แล้วในระบบ',
        ],
        'password'          => [
            'required'  => 'โปรดระบุรหัสผ่าน',
            'confirmed' => 'ยืนยันรหัสผ่านไม่ตรงกัน',
            'min'       => 'รหัสผ่านต้องมีความยาวไม่น้อยกว่า :min ตัวอักษร',
        ],
        'old-password'      => [
            'required'  => 'โปรดระบุรหัสผ่านเดิม',
        ],
        'g-recaptcha-response'  => [
            'required'  => 'โปรดพิสูจน์ว่าคุณไม่ได้เป็นโปรแกรมอัตโนมัติ',
        ],
        'rfid'              => [
            'required'  => 'โปรดระบุคีย์ RFID',
        ],

        // Profile
        'file-avatar' => [
            'required'  => 'โปรดเลือกรูปภาพ',
        ],
        'firstname' => [
            'required'  => 'โปรดระบุชื่อ',
        ],
        'lastname' => [
            'required'  => 'โปรดระบุนามสกุล',
        ],
        'tel' => [
            'required'  => 'โปรดระบุหมายเลขโทรศัพท์',
        ],
        'province' => [
            'required'  => 'โปรดระบุจังหวัด',
        ],
        'city' => [
            'required'  => 'โปรดระบุเขต/อำเภอ',
        ],
        'district' => [
            'required'  => 'โปรดระบุแขวง/ตำบล',
        ],
        'zipcode' => [
            'required'  => 'โปรดระบุรหัสไปรษณีย์',
        ],
        'address' => [
            'required'  => 'โปรดระบุที่อยู่',
        ],
        'file-student-avatar' => [
            'required'  => 'โปรดเลือกรูปภาพนักเรียน',
        ],
        'student-perfix' => [
            'required'  => 'โปรดระบุคำนำหน้าชื่อ',
        ],
        'student-firstname' => [
            'required'  => 'โปรดระบุชื่อนักเรียน',
        ],
        'student-lastname' => [
            'required'  => 'โปรดระบุนามสกุลนักเรียน',
        ],
    ],

];
