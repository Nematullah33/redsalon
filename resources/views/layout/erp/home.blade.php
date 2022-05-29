<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield("title") | Red Salon</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords"
        content="red Salon" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets')}}/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('assets')}}/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('assets')}}/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/icon/icofont/css/icofont.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style.css">
    <!-- New Added -->
   
      <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- Datepicker end -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets')}}/js/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @toastr_css

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('layout.erp.topbar')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('layout.erp.sidebar')
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        
                        <!-- Page-header end -->

                        @yield("content")


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('assets')}}/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="{{asset('assets')}}/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="{{asset('assets')}}/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('assets')}}/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="{{asset('assets')}}/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets')}}/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="{{asset('assets')}}/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- menu js -->
    <script src="{{asset('assets')}}/js/pcoded.min.js"></script>
    <script src="{{asset('assets')}}/js/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="{{asset('assets')}}/js/script.js "></script>

    <!-- addNew -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js')}}/cart.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    @toastr_render
    
    <script>
        function generatePDF() {
				// Choose the element that our invoice is rendered in.
				const element = document.getElementById('invoice');
				// Choose the element and save the PDF for our user.
				html2pdf().from(element).save();
			}
    </script>
</body>

</html>