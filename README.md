<p align="center"><a href="https://nadsoft.net" target="_blank"><img src="https://nadsoft.net/images/logo_new.png" width="400"></a></p>



## About Nadsoft
 
Nadsoft offers over 15 years of software development for enterprises, and proven track record in scaling startups to the next level. We believe the right way to ensure the best results is to help our clients in all stages of development, starting from building the business case & MRD all the way to development, QA & user feedback. Our team provides end-to-end management to the whole process. We specialize in building web and mobile applications, enterprise software with deep-technology integration.




## Nadsoft Laravel Template

We have Laravel Front End Template with most populer libraries 
ex.bootstrap,Jquery,Fontawsome,etc...

## Laravel Structure Design

We have Stander laravel design template start with

- layouts 
    - app
    - navbar
    - footer
    - google analytics
- index 

## app File
### content all design base with include google analytics code.

## navbar File
### must content navbar design code .

## footer File
### must content footer design code .

## Google File
### content Google google analytics code  provied code by .env file -DevOps-.

## yield Section
- ### meta_keyword 
#### You can write meta keyword in this section
- ### meta_description 
#### You can write meta Description in this section
- ### title_Page 
#### You must pass Page Title to this section 
- ### style
#### You can write style or call link style in this section 
- ### fonts 
#### You can write fonts url to this section 
- ### body 
#### You must Write Body Code in this section 
- ### script 
#### You can write JS Code or call script in this section

## Frontend Plugins
- **[Bootstrap](https://getbootstrap.com/docs/4.1/getting-started/introduction/)**
    #### Most CSS Framework Populer
    >Already Called in app file
- **[Jquery](https://api.jquery.com/category/effects/basics/)**
     #### Most JS Framework Populer
     >Already Called in app file
- **[FontAwsome](https://fontawesome.com/icons?d=gallery)**
    #### Use Icon 
    >Already Called in app file
- **[Accessible](https://www.npmjs.com/package/open-accessibility)**
    ####  Accessible tools for People with special needs 
    ``` 
    <!-- Accessible CSS --> 
    <link href="{{asset('assets/plugins/accessible/open-accessibility.min.css')}}">
    
    <!-- Accessible JS --> 
    <script src="{{asset('assets/plugins/accessible/open-accessibility.min.js')}}"></script>
  ```
- **[Animate](https://animate.style/)**
    ####  Css plugin to Use Animations easily
     ``` 
    <!-- Animate CSS --> 
    <link href="{{asset('assets/plugins/animate/animate.min.css')}}">
  ```
- **[ChartJs](https://www.chartjs.org/docs/latest/)**
    #### JS Plugin to show chart & Statistic
     ``` 
    <!-- Chart CSS --> 
    <link href="{{asset('assets/plugins/chart-js/chart.min.css')}}">
    
    <!--  Chart JS -->
    <script src="{{asset('assets/plugins/chart-js/chart.min.js')}}"></script>
  ```
- **[Dark Mode](https://darkmodejs.learn.uno/)**
   #### JS Plugin Swap Website to Dark Mode
    ``` 
    <!-- Dark mode JS --> 
    <script src="{{asset('assets/plugins/dark-mode/darkmode-js.min.js')}}"></script>
  ```
- **[Datatable](https://datatables.net/manual/installation)**
   #### provide your table Features  
    ``` 
    <!-- Data Table CSS --> 
    <link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}">
    <link href="{{asset('assets/plugins/datatable/dataTables.jqueryui.min.css')}}">
    <link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}">
    
    <!-- Data Table JS --> 
    <script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.jqueryui.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
  ```
- **[Hover](https://ianlunn.github.io/Hover/)**
   #### Great  Css Hover plugin 
    ``` 
    <!-- Hover Plugin CSS --> 
    <link href="{{asset('assets/plugins/hover/hover-min.css')}}">
  ```
- **[jquery-lazy-master](https://github.com/dkern/jquery.lazy)**
   #### JS plugin used to lazy load image 
    ```
    <!-- Jquery Lazy JS --> 
    <script src="{{asset('assets/plugins/jquery-lazy-master/jquery.lazy.min.js')}}"></script>
  ```
- **[jquery-ui](https://api.jqueryui.com/)**
   #### plugins for jquery curated set of user interface
    ``` 
    <!-- Jquery UI Plugin CSS --> 
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}">
    
    <!-- Jquery UI Plugin JS --> 
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  ```
- **[jquery-validation](https://jqueryvalidation.org/reference/)**
   #### plugins for jquery to validated form filed
    ``` 
    <!-- Jquery Validation JS Defualt English Translate --> 
    <script src="{{asset('assets/plugins/jquery-validation/jquery-validate.min.js')}}"></script>
    <!-- Translate Validation -->  
    <script src="{{asset('assets/plugins/jquery-validation/messages_ar.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-validation/messages_he.min.js')}}"></script>
  ```
- **[lightbox](https://lokeshdhakar.com/projects/lightbox2/)**
   #### Show image in Model 
    ``` 
    <!-- Light Box CSS --> 
    <link href="{{asset('assets/plugins/lightbox/lightbox.min.css')}}">
    
    <!-- Light Box JS --> 
    <script src="{{asset('assets/plugins/lightbox/lightbox.min.js')}}"></script>
  ```
- **[ck-editor](https://ckeditor.com/docs/ckeditor5/latest/builds/guides/overview.html)**
    #### For Textare rich editor sush as (Word toolbar)
     ``` 
    <!--Ck Editor JS --> 
    <script src="{{asset('assets/plugins/ck-editor/ck-editor.min.js')}}"></script>

   <!-- Ck Editor Translate -->  
    <script src="{{asset('assets/plugins/ck-editor/ar.min.js')}}"></script>
    <script src="{{asset('assets/plugins/ck-editor/he.min.js')}}"></script>
  ```
- **[nicedit](http://nicedit.com/demos.php)**
   #### For Textare rich editor sush as (Word toolbar)
    ``` 
    <!-- Nicedit JS --> 
    <script src="{{asset('assets/plugins/nicedit/nicEdit.min.js')}}"></script>
  ```
- **[tinymce](https://www.tiny.cloud/docs/quick-start/)**
   #### For Textare rich editor sush as (Word toolbar)
    ``` 
    <!--tinymce JS --> 
    <script src="{{asset('assets/plugins/tinymce/theme.min.js')}}"></script>
  ```
- **[owl-carousel](https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html)**
   #### Most Slider used 
    ``` 
    <!-- owl-carousel CSS --> 
    <link href="{{asset('assets/plugins/owl-carousel/owl.carousel.min.css')}}">
    <link href="{{asset('assets/plugins/owl-carousel/owl.theme.default.min.css')}}">
    
    <!-- owl-carousel JS --> 
    <script src="{{asset('assets/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
  ```
- **[propper](https://popper.js.org/docs/v2/tutorial/)**
   #### plugins for Animate 
    ``` 
    <!--propper JS --> 
    <script src="{{asset('assets/plugins/propper/propper.min.js')}}"></script>
  ```

- **[select2](https://select2.org/getting-started/basic-usage)**
   #### multi select and enabled you to design option 
    ``` 
    <!-- Select2 CSS --> 
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}">
    
    <!-- Select2 JS --> 
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
  ```

- **[skrollr](https://github.com/Prinzhorn/skrollr)**
   #### plugins for landing page to checnge content in scroll
    ``` 
   <!-- skrollr JS -->  
    <script src="{{asset('assets/plugins/skrollr/skrollr.min.js')}}"></script>
  ```

- **[slick](https://kenwheeler.github.io/slick/)**
   #### Slider Plugin
    ``` 
    <!-- Slick CSS --> 
    <link href="{{asset('assets/plugins/slick/slick.min.css')}}">
    <link href="{{asset('assets/plugins/slick/slick-theme.min.css')}}">
    
    <!--  Slick JS -->
    <script src="{{asset('assets/plugins/slick/slick.min.js')}}"></script>
  ```

- **[sweetalert2](https://sweetalert2.github.io/)**
   #### Awesome ALert pop up 
    ``` 
    <!-- sweetalert2 JS --> 
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert2@10.js')}}"></script>
  ```

- **[toastr](https://codeseven.github.io/toastr/demo.html)**
   #### Alert notification plugin
    ``` 
     <!--  Toastr CSS -->
    <link href="{{asset('assets/plugins/toastr/toastr.css')}}">
    
    <!-- Toastr JS --> 
   <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
  ```

- **[typed](https://mattboldt.com/demos/typed-js/)**
   #### plugins animated text in show
    ``` 
    <!-- Typed JS --> 
    <script src="{{asset('assets/plugins/typed/typed.min.js')}}"></script>
  ```

  - **[Jquery Form](http://malsup.com/jquery/form/)**
   #### Js plugins Jquery Form
    ``` 
    <!-- JQuery Form  JS --> 
  <script src="{{asset('assets/plugins/jquery-form/jquery.form.min.js')}}"></script>
  ```

  - **[Jquery knob](https://github.com/aterrien/jQuery-Knob)**
   #### Js plugins Jquery Knob -Range value- 
    ``` 
  <!-- Jquery-Knob -->
    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  ```

- **[Jquery Touch](https://codepen.io/buoge/pen/EpyGMX)**
   #### Js plugins Jquery Touch -Mobile Touch- 
    ``` 
  <!-- Jquery-Ui -->
     <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Jquery-touch -->
    <script src="{{asset('assets/plugins/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script>
  ```

- **[Full Calender](https://fullcalendar.io/#demos)**
   #### Js plugins Full Calender  -Calender Js- 
    ``` 

    <!-- FullCalender Css  -->
    <link href="{{asset('assets/plugins/full-calendar/fullcalendar.min.css')}}">
    <!-- FullCalender JS -->
    <script src="{{asset('assets/plugins/full-calendar/fullcalendar.min.js')}}"></script>
    <!-- FullCalender Translate ar  -->
    <script src="{{asset('assets/plugins/full-calendar/ar-sa.min.js')}}"></script>
    <!-- FullCalender Translate he  -->
    <script src="{{asset('assets/plugins/full-calendar/he.min.js')}}"></script>
  ```


- **[video-js](https://docs.videojs.com/tutorial-setup.html)**
   #### plugins for controlr video
    ``` 
    <!-- Video PLugin CSS -->
    <link href="{{asset('assets/plugins/video-js/video.min.css')}}">
    
   <!-- video Plugin JS --> 
    <script src="{{asset('assets/plugins/video-js/video.min.js')}}"></script>
    <!-- Video Plugin Translate -->  
    <script src="{{asset('assets/plugins/video-js/ar.min.js')}}"></script>
    <script src="{{asset('assets/plugins/video-js/he.min.js')}}"></script>
  ```

- **[Masonry-js](https://github.com/desandro/masonry)**
   #### Masonry js is plugins for Sort Image 
    ``` 
    <!--  Masonry JS -->
    <script src="{{asset('assets/plugins/masonry/masonry.pkgd.min.js')}}">
  ```

  - **[Aos](https://github.com/michalsnik/aos)**
   #### Aos Animate Css 
    ``` 
    <!--  Aos Css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/aos/aos.css')}}">
    
    <!--  Aos JS -->
     <script src="{{asset('assets/plugins/aos/aos.js')}}"></script>
  ```


- **[Ui Avatar](https://ui-avatars.com/api/?name=Waleed%20hamdan)**
   #### api to show name as avatar img 

   [Tryit](https://ui-avatars.com/api/?name=Waleed%20hamdan)

  !['Ui Avatar'](https://ui-avatars.com/api/?name=Waleed%20hamdan)

1 first clone repo 

```bash
git clone repo_name

```
the go into repo_name

then
```bash
rm -rf .git

```

# hawas
