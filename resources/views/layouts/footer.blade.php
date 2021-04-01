{{-- Add Footer Code Here --}}

<footer class="mt-5 footer-background">
    <div class="container pt-5">
        <div class="row footer-border-div pb-4">
            <div class="col-md-5 text-md-right text-center">
                <p class="footer-title">
                    الفية حواس
                </p>
                <p class="footer-text">
                    مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى
                    الشرائح المجتمعية.
                </p>
                <div class="footer-contact">
                    <a href="tel:@setting('social.phone1')" class="footer-call d-block">
                        <span>
                            <i class="fa fa-phone-alt callIcon"></i>
                        </span>
                        <span class="contact-span-footer pr-2">
                            @setting('social.phone1') - @setting('social.phone2')
                        </span>
                    </a>
                    <a href="mailto:@setting('social.email')" class="footer-email">
                        <span>
                            <i class="fas fa-envelope emailIcon"></i>
                        </span>
                        <span class="contact-span-footer pr-2">
                            @setting('social.email')
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-md-right text-center mt-md-0 mt-4">
                <p class="footer-title m-0">
                    محتويات الموقع
                </p>
                <div class="n">
                    <li class="pt-1">
                        <a href="{{ route('programs.index') }}" class="footer-link-menu">
                            برامجنا
                        </a>
                    </li>
                    <li class="pt-1">
                        <a href="{{ route('blogs.index') }}" class="footer-link-menu">
                            المدونة
                        </a>
                    </li>
                    <li class="pt-1">
                        <a href="{{ route('channel.index') }}" class="footer-link-menu">
                            قناة حواس
                        </a>
                    </li>
                    <li class="pt-1">
                        <a href="{{ route('about') }}" class="footer-link-menu">
                            من نحن
                        </a>
                    </li>
                    <li class="pt-1">
                        <a href="{{ route('contact.index') }}" class="footer-link-menu">
                            اتصل بنا
                        </a>
                    </li>
                </div>
            </div>
            <div class="col-md-3 text-md-right text-center mt-md-0 mt-4">
                <p class="footer-title m-0">
                    ابحث في الموقع
                </p>
                <form action="{{ route('search') }}" method="GET" class="search-container position-relative pt-2">
                    <input value="{{ request()->has('search') ? request()->get('search') : '' }}" type="text" class="search-footer" placeholder="ابحث في حواس …" name="search">
                    <button type="submit" class="search-button">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </form>
                <p class="contact-footer-text mt-3">
                    تواصل معنا على مواقع التواصل الاجتماعي
                </p>
                <div class="">
                    <span class="socialMediaIcon">
                        <a target="_blank" href="@setting('social.facebook_url')">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </span>
                    <span class="socialMediaIcon pr-3">
                        <a target="_blank" href="@setting('social.instagram_url')">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </span>
                    <span class="socialMediaIcon pr-3">
                        <a target="_blank" href="@setting('social.youtube_url')">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-8 text-center">
                <p class="m-0 text-md-right">
                    <span class="copy_text"> جميع الحقوق محفوظة </span>
                    <a href="">
                        <span class="hawas_text">الفية حواس </span>
                    </a>
                    <span class="copy_text">
                        <span class=" footer-year-text position-absolute pr-3"> 2020 </span>
                        <i class="far fa-copyright"></i>
                    </span>
                </p>
            </div>
            <div class="col-md-4 text-center">
                <p class="">
                    <span class="copy_text">
                        تصميم وتطوير
                    </span>
                    <span class="pr-1">
                        <a href="https://nadsoft.net/" target="_blank">
                            <img src="{{ asset('assets/images/nadsoftlogo.png') }}" class="nadsoft_logo">
                        </a>
                    </span>
                </p>
            </div>
        </div>
    </div>
</footer>
