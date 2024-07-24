<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Admin Panel | DORA®</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="noindex">

    <!-- App favicon -->

    <link rel="manifest" href="{{ asset('public/assets/images/fav/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('public/assets/images/fav/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">

    <link href="/admin-panel/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/admin-panel/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="/admin-panel/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="/admin-panel/assets/js/config.js"></script>
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/hfyu36puzcs9806n61g9dwzuk9ru0lq2o7j4jdrii3mhatrb/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>-->
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>


</head>

<style>
    .removeBtn {
    background: none;
    border: none;
    padding: 0;
    margin: 0;
    color: #346ee0;
    }
</style>
<body>

<!-- Begin page -->
<div class="layout-wrapper">
    <x-superheader></x-superheader>
    <div class="px-3">
        @yield('content')
    </div>
    <x-superfooter></x-superfooter>
</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- App js -->
<script src="/admin-panel/assets/js/vendor.min.js"></script>
<script src="/admin-panel/assets/js/app.js"></script>

<!-- Knob charts js -->
<script src="/admin-panel/assets/libs/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline Js-->
<script src="/admin-panel/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<!--<script src="/admin-panel/assets/libs/morris.js/morris.min.js"></script> -->

<script src="/admin-panel/assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init-->
<script src="/admin-panel/assets/js/pages/dashboard.js"></script>

</body>

</html>
