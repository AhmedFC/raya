@if(session()->has('error'))
<div class="alert alert-style my-1 m-auto px-3 alert-warning alert-dismissible fade show w-alert" role="alert">
  <div class="d-flex align-items-center  gap-2    justify-content-between">
    <!-- <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6> -->
  </div>
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-style my-2 m-auto px-3 alert-success alert-dismissible fade show w-alert" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<?php $user = auth()->user() ?>
@if($user?->type =='vendor')
{{--@if(!$user->birthdate||!$user->email||!$user->phone||--}}
{{--!$user->id_number||!$user->id_end||!$user->city_id||--}}
{{--!$user->occupation_id||!$user->years_of_experience||--}}
{{--!$user->qualification_id||!$user->bio||!$user->photo||--}}
{{--!$user->license||!$user->bank_account||--}}
{{--!$user->tax_number)--}}
<?php
                $requiredFields = [
                    // 'birthdate' => 'تاريخ الميلاد',
                    'email' => 'البريد الإلكتروني',
                    'phone' => 'رقم الهاتف',
                    // 'id_number' => 'رقم الهوية',
                    // 'id_end' => 'تاريخ انتهاء الهوية',
                    // 'city_id' => 'مدينة الإقامة',
                    // 'occupation_id' => 'المهنة',
//                    'years_of_experience' => 'سنوات الخبرة',
//                    'qualification_id' => 'المؤهل العلمي',
                    'bio' => 'نبذة عنك',
                    'image' => 'صورة شخصية',
//                    'license' => 'الترخيص',
//                    'bank_account' => 'رقم الحساب البنكي',
                ];
                $missingFields = [];
//                if ($user->has_tax_certificate) {
//                    $requiredFields['tax_number'] = 'رقم الضريبي';
//                    $requiredFields['tax_certificate'] = 'الشهادة الضريبية';
//                }

                foreach ($requiredFields as $field => $fieldName) {
                    if (empty($user->$field)) {
                            $missingFields[] = $fieldName;
                    }
                }
                ?>
@if(!empty($missingFields))
<div class="alert w-50 my-1 m-auto px-3 alert-warning alert-dismissible fade show w-alert" role="alert">
  <div class="d-flex align-items-center  gap-2    justify-content-between">
    <!-- <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6> -->
  </div>
  <ol class="mb-0">
    يجب اكمال البيانات الاتية
    ({{ implode('-',$missingFields) }})
    لتفعيل العضوية
    <a href="{{route('profile')}}" style='text-decoration: underline;color:#0065d0'>
      اضغط هنا للانتقال
    </a>
  </ol>
  <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@endif


@if(count($errors->all()) > 0)
<div class="alert alert-style my-2 m-auto px-3 alert-warning alert-dismissible fade show w-alert" role="alert">
  <div class="d-flex align-items-center  gap-2    justify-content-between">
    <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6>
  </div>
  <ol class="mb-0">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ol>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
