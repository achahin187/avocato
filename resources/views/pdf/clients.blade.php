<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style> 
        body { 
            font-family: DejaVu Sans, sans-serif; 
            direction: rtl !important; 
            text-align: right !important;
            align: right;
        }
    </style>
  </head>
  <body>


      <table border="1" >

        <thead>
            <tr>
                <th>كود العميل</th>
                <th>اسم العميل</th>
                <th>البريد الالكتروني</th>
                <th>عنوان العميل</th>
                <th>هاتف</th>
                <th>نوع الباقة</th>
                <th>بداية التعاقد</th>
                <th>نهاية التعاقد</th>
                <th>حالة التفعيل</th>
            </tr>
        </thead>
        <tbody>
          
        @foreach ($usersPDF as $user)
        <tr>
            <td>
                {{ $user->code }}
            </td>
            <td>
                {{ $user->full_name ? $user->full_name : 'غير معرف' }}
            </td>
            <td>
                {{ $user->email ? $user->email : 'غير معرف' }}
            </td>
            <td>
                {{ $user->address ? $user->address : 'غير معرف' }}
            </td>
            <td>
                {{ $user->mobile ? $user->mobile : 'غير معرف' }}
            </td>
            <td>
                {{ $user->subscription ? Helper::localizations('package_types', 'name', $user->subscription->package_type_id) : 'غير معرف' }}
            </td>
            <td>
                {{ $user->subscription ? $user->subscription->start_date->format('d/m/Y') : 'غير معرف' }}
            </td>
            <td>
                {{ $user->subscription ? $user->subscription->end_date->format('d/m/Y') : 'غير معرف' }}
            </td>
            <td>
                {{ $user->is_active ? 'فعال' : 'غير فعال' }}
            </td>
        </tr>
        @endforeach

        </tbody>
      </table>

  </body>
</html>
