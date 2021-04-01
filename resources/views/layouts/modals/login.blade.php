<div class="modal fade" id="sure-menuModal" tabindex="-1" role="dialog" aria-labelledby="sure-menuModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content sureModal-menu-style sure-menuModal">
            <div class="modal-header remove-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fas fa-times close-icon"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body  pr-5 pl-5 pb-5 pt-2 remove-border">
                <div class="row justify-content-center m-0">
                    <div class="col-12 text-center">
                        <p class="m-0 login-title-menu-modal"> تسجيل الدخول </p>
                        <p class="login-text-menu-modal"> ادخل اسم المستخدم وكلمة المرور التي استلمتها من مدرستك</p>
                    </div>
                </div>
                <form action="{{route('login')}}" method="POST" class="row mt-5 justify-content-center submit_form_via_ajax login">
                    @csrf
                    <div class="col-md-6 text-md-right text-center">
                        <label class="label-menu-modal m-0">اسم المستخدم</label>
                        <input name="username" type="text" class="input-menu-modal">
                    </div>
                    <div class="col-md-6 pt-1 text-md-right text-center">
                        <label class="label-menu-modal m-0">كلمة المرور</label>
                        <input name="password" type="password" class="input-menu-modal">
                    </div>
                    <div class="col-md-5 text-center mt-3">
                        <button class="login-button-menu-modal border-0 outline-none">
                            <span class="login-menu-button">
                                دخول
                            </span>
                        </button>
                    </div>
                    <div class="col-12 mt-2 text-center">
                        <span class="forgot-menu-text">نسيت كلمة المرور؟</span>
                        <span>
                            <a href="{{ route('contact.index') }}" class="contactUs-menu-modal">
                                تواصل معنا
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
