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
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'حقل :attribute يجب أن يكون بين :min و :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'حقل :attribute يجب أن يكون بين :min و :max حروف.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'حقل :attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'حقل :attribute يجب أن يكون صوره.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'حقل :attribute لا يمكن أن يكون أكبر من  :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'حقل :attribute لا يمكن أن يكون أكبر من :max حروف.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'حقل :attribute يجب أن يكون نوع: :values.',
    'mimetypes'            => 'حقل :attribute يجب أن يكون ملف type: :values.',
    'min'                  => [
        'numeric' => 'حقل :attribute يجب أن يكون على الأقل :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'حقل :attributeيجب أن يكون على الأقل :min حروف.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'حقل :attribute يجب أن يكون رقم.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'حقل :attribute مطلوب',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'حقل :attribute و :other يجب أن يتطابقان.',
    'size'                 => [
        'numeric' => 'حقل :attribute يجب أن يكون :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'حقل :attribute يجب أن يكون :size حروف.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'حقل :attribute يجب أن يكون نص .',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ' :attribute محجوز بالفعل',
    'uploaded'             => 'حقل :attribute فشل فى التحميل.',
    'url'                  => 'The :attribute format is invalid.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [


        'new_type' => 'نوع جديد',
        'court' => 'محكمه',
        'govs' => 'المحافظه',
        'cities' => 'المدينه',
        'main' => 'التصنيف الرئيسي',
        'mains' => 'التصنيف الرئيسي',
        'subs' => 'التصنيف الفرعي',
        'gov_name' => 'إسم المحافظة',
        'government_name' => 'إسم المحافظة',
        'city_name'=> 'إسم المدينة',
        'contract_name'=>'اسم العقد',
        'image'=>'الصوره',
        'file'=>'الملف',
        'is_contract'=>'الصيغه أو العقد',
        'newsName'  => 'عنوان الاخبار',
        'newsContent' => 'تفاصيل الخبر',
        'user_name'=>'اسم المستخدم',
       'full_name'=>'الاسم بالكامل',
       'role'=>'دور المستخدم',
       'email'=>'البريد الإلكترونى',
       'phone'=>'الهاتف',
       'mobile'=>'الموبايل',
       'password'=>'كلمه المرور',
       'confirm_password'=>'تأكيد كلمه المرور',
       'image'=>'الصوره',
       'lawyer_name'=>'اسم المحامى',
       'note'=>'النبذه ',
       'consultation_price'=>'سعر الاستشاره',
       'address'=>'العنوان',
       'national_id'=>'الرقم القومى',
       'nationality'=>'الجنسيه',
       'birthdate'=>'تاريخ الميلاد',
       'work'   => 'المسمى الوظيفي',
       'work_sector'=>'قطاع العمل',
       'work_sector_area'=>'الإختصاص المكانى',
       'join_date'=>'تاريخ الإلتحاق بالعمل بالشركه',
       'resign_date '=>'تاريخ انتهاء العمل بالشركة',
       'work_type'=>'نوع العمل',
       'authorization_copy'=>'صورة التوكيل',
       'syndicate_level_id'=>'درجة القيد بالنقابة',
       'syndicate_copy'=>'صورة كارنيه النقابة',
       'litigation_level'=>'درجه التقاضي',
        'discount_rate' => 'قيمة التخفيض',
        'start_date'    => 'تاريخ البداية',
        'end_date'      => 'تاريخ النهاية',
        'subscription_duration' => 'مدة التعاقد',
        'subscription_value'    => 'قيمة التعاقد',
        'name'  => 'الاسم',
        'job'   => 'المسمى الوظيفي',
        'national_id'   => 'الرقم القومي',
        'birthday'  => 'تاريخ الميلاد',
        'number_of_payments' => 'عدد الاقساط',
        'commercial_registration_number' => 'رقم السجل التجاري',
        'fax'   => 'فاكس',
        'website' => 'موقع الشركة علي الانترنت',
        'legal_representative_mobile' => 'اسم الممثل القانوني للشركة',
        'legal_representative_name' => 'اسم الممثل القانوني للشركة',
        'company_name'  => 'اسم الشركة',
        'office_name'  => 'اسم المكتب',
        'ind_name'      => 'اسم المكتب',
        'personal_image'=> 'الصورة الشخصية',
        'discount_percentage' => 'قيمة الخصم',
        'duration'      => 'مدة التعاقد',
        'value'         => 'القيمة',
        'logo'          => 'شعار الشركة',
        'gender' => 'النوع',
        'company_code' => 'كود الشركة',
        'client_code'=> 'كود العميل',
        'service_name'=> 'اسم الخدمه',
        'service_type'=>'نوع الخدمه',
        'service_expenses'=>'رسوم الخدمه',
        'service_status'=>'حاله الخدمه',
        'amount'=>'المبلغ',
        'is_paid'=>'حاله السداد',
        'reason'=>'السبب',
        'service_date'=>'تاريخ الخدمه',
        'date'=>'التاريخ',
        'rate'=>'التقييم',
        'notes'=>'الملاحظات',
        'number' => 'الرقم',
        'pen' => 'قلم المحضرين',
        'delivery_date' => 'تاريخ التسليم',
        'delivered_at' => 'تاريخ التسلم',
        'session_date' => 'تاريخ الجلسة',
        'notes' => 'الملاحظات',
        'package_type'=>'نوع الباقه',
        'notification'=>'نص التنبيه',
        'language'=>'اللغه',
    ],

];
