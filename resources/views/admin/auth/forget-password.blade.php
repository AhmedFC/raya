<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('admin.layouts.parts.head')

<body>
  <!-- Start layout -->
  <section class="login_page">
  <div class="box-col d-flex flex-column justify-content-center py-xl-0">
      <form action="" method="POST" class="form_content">
      <img src="{{ asset('admin-asset/img/Logo.png') }}" alt="logo" class="logo-form" />
        <h3 class="header_title">
          <div class="title">إعادة تعيين كلمة المرور</div>
          <div class="text">سوف يتم إرسال كود التحقق الي البريد الخاص بك</div>
        </h3>
        <div class="row gap-3 ">
          <div class="col-12 ">
            <label for="" class="label">البريد الالكتروني أو رقم الهاتف</label>
            <div class="group-inp">
              <input type="email" placeholder="name@company.com" name="email" id="" class="inp">
              <div class="box">
                <img src="{{ asset('admin-asset') }}/img/icons/sms.svg" class="icon" alt="">
              </div>
            </div>
          </div>
          <div class="col-12 d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.login') }}" class="reseat">العودة إلي صفحة تسجيل الدخول</a>
          </div>
          <div class="col-12">
            <button type="submit" class="sub_btn btn btn-primary w-100">إرسال</button>
          </div>
        </div>
      </form>
    </div>
    <div class="box-col box-bg d-flex flex-column justify-content-between align-items-center gap-5 text-center">
      <img src="{{ asset('admin-asset') }}/img/login/login-bg.jpg" alt="img-bg" class="bg" />
      <img src="{{ asset('admin-asset/img/Logo.png') }}" alt="logo" class="logo-bg" />
      <div class="text-bg">
        <div class="title">
          سلاش
        </div>
        <div class="p">
          خدمات مميزة وتجربة جديدة
        </div>
      </div>
      <div class="text-bg-2">
        شركة سعودية
      </div>
    </div>
  </section>
  <!-- End layout -->
  <!-- Js Files -->
  @include('admin.layouts.parts.footer')
</body>

</html>
