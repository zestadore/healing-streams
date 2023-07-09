<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon.png" rel="icon" />
<title>Healing Streams TV</title>
<meta name="description" content="This professional design html template is for build a Money Transfer and online payments website.">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css" />
<script src="https://kit.fontawesome.com/30015c5a7c.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://healingstreams.tv/css/style.css" />
{{-- <link rel="stylesheet" type="text/css" href="assets/all.min.css" /> --}}
<link rel="stylesheet" type="text/css" href="assets/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="assets/currency-flags.min.css" />
<link rel="stylesheet" type="text/css" href="assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="assets/style.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
<style>
  .select2-container .select2-selection--multiple {
    min-height: 50px !important;
  }
  
</style>
<body>

<!-- Preloader -->
{{-- <div id="preloader">
  <div data-loader="dual-ring"></div>
</div>  --}}
<!-- Preloader End --> 
<!-- Header============================================= -->
    <header id="header" class="bg-dark">
      <div class="container">
        <div class="row container">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="color:white;padding:10px;">
            info@healingstreams.tv &nbsp;&nbsp;&nbsp;
            <a href="tel:+44 (0) 333 188 0710"></a><i class="fa fa-phone"></i> +44 (0) 333 188 0710
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="color:white;padding:10px;text-align:right;">
              <a href="https://healingstreams.tv/about.php">About us</a>&nbsp;&nbsp;&nbsp;
              <a href="https://kingschat.online/user/hstv"><img src="images/kingschat.png" alt="Kingschat" style="width:13% !important;"></a>
          </div>
      </div>
      <div class="header-row" style="padding:10px;top:0px;">
          <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          
          <div class="logo me-3"> <a class="d-flex" href="https://healingstreams.tv" title="Healing streams"><img src="images/logo.png" style="border-radius:10px;" alt="Healing Streams" class="img"/></a> </div>
          <!-- Logo end --> 
          </div>
          <div style="float:right !important;"><a href="https://healingstreams.tv" class="btn btn-outline-primary">Home</a></div>
          
      </div>
      </div>
  </header>
  <!-- Header End -->
  <section class="hero-wrap">
    <div class="hero-mask opacity-7 hero-background-image" style="background-image: url(images/hslhsneww.jpg);">
    </div>
    <div class="hero-content d-flex flex-column fullscreen-with-header" >
      <div class="container my-auto py-5">
        <div class="row">
          <div class="col-lg-12 col-xl-12">
            <h1 class="h1-text-style">HEALING STREAMS TV PARTNERSHIP PAGE</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  
 
  <!-- Content
  ============================================= -->
  <div id="content"> 
    @if (session('error'))
        <div class="alert alert-danger alert-dismissable" role="alert">
            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> --}}
            <p class="mb-0" style="font-size:20px;">{{ session('error') }}</p>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable" role="alert">
            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> --}}
            <p class="mb-0" style="font-size:20px;">{{ session('success') }}</p>
        </div>
    @endif
    <!-- Send Money
    ============================================= -->
    
    <!-- Send Money End --> 
    <div class="container body-container">
      <div class="bg-white rounded shadow-md p-4">
        <div id="google_translate_element" class="google_translate_element"></div>

          <script type="text/javascript">
          function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
          }
          </script>

          <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <h3 class="text-5 mb-4 text-center" style="color:rgb(0, 128, 0);">Enter your details below <br> Select your preferred payment channel to give or make a pledge</h3>
        <hr class="mb-4 mx-n4">
        <form id="form-send-money" method="post" action="{{route('payment.process')}}">@csrf
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="mb-3">
                <label for="first_name" class="form-label">First name</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label for="last_name" class="form-label">Last name</label>
              <div class="input-group">
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label for="email" class="form-label">Email id</label>
              <div class="input-group">
                  <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Email id" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label for="partnership_categories" class="form-label">Partnership categories</label>
              <div class="input-group">
                <select name="partnership_categories[]" id="partnership_categories" class="form-select" multiple="multiple" required>
                    <option value="">Select your category</option>
                    <option value="HSLHS with Pastor Chris">HSLHS with Pastor Chris</option>
                    <option value="Healing Streams TV">Healing Streams TV</option>
                    <option value="Healing to the Nations Magazine">Healing to the Nations Magazine</option>
                </select>
              </div>
            </div>
          </div><br>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label for="country" class="form-label">Country</label>
              <div class="input-group">
                <select name="country_id" id="country_id" class="form-select" required>
                    <option value="">Select your country</option>
                    @foreach ($countries as $item)
                        <option value="{{$item->id}}">{{$item->country}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label for="youSend" class="form-label">Phone no</label>
              <div class="input-group">
                  <span class="input-group-text p-0">
                    <select id="youSendCurrency" data-style="form-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control bg-transparent" required>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->telephone_code}} </option>
                        @endforeach
                    </select>
                  </span>
                  <input type="number" class="form-control" data-bv-field="phone_no" id="phone_no" name="phone_no" placeholder="Phone no" required>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <label for="currency" class="form-label">Currency</label>
                <div class="input-group">
                  <select name="currency_id" id="currency_id" class="form-select" required>
                      <option value="">Select your currency</option>
                  </select>
                </div>
            </div>
          </div><br>
          <div class="row">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row" style="padding-top:40px;">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <input type="radio" id="html" name="choice" class="choiceClass" value="0" checked>
                            <label for="html">One-off</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <input type="radio" id="css" name="choice" class="choiceClass" value="1">
                            <label for="css">Monthly (Subscription)</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <input type="radio" id="javascript" name="choice" class="choiceClass" value="2">
                            <label for="javascript">Make a pledge</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <label for="amount" class="form-label">Amount</label>
                  <div class="input-group">
                    <span class="input-group-text" id="symbol_span">$</span>
                      <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="paymentOptions">
                  {{-- <label for="payment_gateway_id" class="form-label">Payment gateway</label>
                  <div class="input-group">
                    <select name="payment_gateway_id" id="payment_gateway_id" class="form-select" required>
                        <option value="">Select payment gateway</option>
                    </select>
                  </div> --}}
                </div>
            </div>
          </div>
          <div class="row" id="pledgeAuto">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <p> </p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="initialising_date" class="form-label">Initializing date</label>
                <div class="input-group">
                  <input type="date" name="initialising_date" id="initialising_date" class="form-control" required>
                  {{-- <select name="initialising_date" id="initialising_date" class="form-select" required>
                    @for ($i = 1; $i <=28; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                  </select> --}}
                </div>
            </div>
          </div>
          <br>
          <div align="right"><button class="btn btn-primary">Continue</button></div>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        </form>
      </div>
    </div>
    <section class="section">
      <div class="container">
        <h2 class="text-9 text-center">PARTNER WITH HEALING STREAMS TV!</h2>
        <p class="lead text-center mb-4">With your heartfelt giving, you can join us to take healing to the nations</p>
        <div class="row">
            <div class="text-center mt-4"><a href="https://healingstreams.tv/partnership" class="text-4 btn btn-outline-success" style="text-decoration:none;">PARTNER<i class="fa fa-heart text-2 ms-2"></i></a></div>
        </div>
        </div>
      </div>
    </section>
  <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <span>Navigation</span>
          <ul style="list-style-type: none;">
            <li><a href="https://healingstreams.tv">Home</a></li>
            <li><a href="https://healingstreams.tv/about.php">About Us</a></li>
            <li><a href="https://healingstreams.tv/programs.php">Programs</a></li>
            <li><a href="https://healingstreams.tv/reports.php">Blog</a></li>
            <!-- <li><a href="https://healingstreams.tv/contacts.php">Contact Us</a></li> -->
          </ul>
        </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <span>Phone lines</span>
            <ul class="addresss-info" style="list-style-type: none;"> 
              <li>
                <i class="fa fa-phone"></i> 
                <a href="tel:+23418885066"> <span>+234 18885066 </span> </a> 
              </li>
              <li>
                <i class="fa fa-phone"></i> 
                <a href="tel:+2348086783344"> <span>+234 808 678 3344</span> </a> 
              </li>
              <li>
                <i class="fa fa-phone"></i> 
                <a href="tel:+2348039816243"> <span>+234 803 981 6243 </span> </a> 
              </li>
              <li>
                <i class="fa fa-phone"></i> 
                <a href="tel:+2779967 5852"> <span> +27 79 967 5852 </span> </a> 
              </li>
              <li>
                <i class="fa fa-phone"></i> 
                <a href="tel:+18327249390"> <span>+1 832 724 9390</span> </a> 
              </li>
             
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <span><p> </p></span>
            <ul class="addresss-info" style="list-style-type: none;text-align:right;"> 
              <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+27 79 967 5853"> <span>+27 79 967 5853 </span> </a> 
                </li>
                  <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+27 11 326 2467"> <span>+27 11 326 2467 </span> </a> 
                </li>
                <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+44 (0) 333 188 0710"> <span>+44 (0) 333 188 0710</span> </a> 
                </li>
                <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+12896221634"> <span>+1 289 622 1634 </span> </a> 
                </li>
                <!-- <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+2348086783344"> <span>+(234) 808-678-3344 </span> </a> 
                </li>
                <li>
                  <i class="fa fa-phone"></i> 
                  <a href="tel:+23418885056"> <span>+(234) 1-888-5066 </span> </a> 
                </li> -->
                <li><i class="fa fa-envelope-o"></i> info@healingstreams.tv</li>
              </ul>
          </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-start mb-2 mb-lg-0">Copyright &copy; {{date('Y')}} <a href="https://healingstreams.tv/" target="_blank">Healing Streams TV</a>. All Rights Reserved.</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end --> 
  
</div>
<!-- Document Wrapper end --> 

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Video Modal
============================================= -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0">
      <button type="button" class="btn-close btn-close-white ms-auto me-n3" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
          <iframe id="video" src="" allow="autoplay;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Video Modal end --> 

<!-- Script --> 
<script src="assets/jquery.min.js"></script> 
<script src="assets/bootstrap.bundle.min.js"></script> 
<script src="assets/bootstrap-select.min.js"></script> 
<script src="assets/owl.carousel.min.js"></script> 
<!-- Style Switcher --> 
<script src="assets/switcher.min.js"></script> 
<script src="assets/theme.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $('#partnership_categories').select2({
    placeholder: "Select categories",
  });
    $('#country_id').change(function(){
      var id=$(this).val();
      var url= "{{route('currencies.list','ID')}}";
      url=url.replace('ID',id);
      $.ajax({
          url: url,
          type:"get",
          success:function(response){
              var list = $("#currency_id");
              var list2 = $("#paymentOptions");
              list.empty()
              list.append(new Option("Select your currency", ""));
              $.each(response.currencies, function(index, item) {
                var text = item.currency + "(" + item.currency_symbol + ")";
                list.append($('<option/>', {
                    value: item.id,
                    text: text,
                    'data-symbol': item.currency_symbol
                }));
              });
              list2.empty()
              var radioBtn ="";
              list2.append(new Option("Select payment gateway", ""));
              $.each(response.payment_gateways, function(index, item) {
                var text = item.payment_gateway;
                radioBtn = $('<div><input type="radio" name="payment_gateway_id" class="payment_options" value="'+item.id+'" checked/><label for="'+text+'"> &nbsp;'+text+'</label><img src="'+window.location.origin+'/images/'+text.toLowerCase()+'.png" width="10%"/></div>');
                list2.append(radioBtn);
              });
          },
      });
    });

    $('#currency_id').change(function(){
      var symbol=$("#currency_id option:selected").attr('data-symbol');
      $('#symbol_span').html(symbol);
    });

    $('#youSendCurrency').change(function(){
      var id=$(this).val();
      $('#country_id').val(id);
      $('#country_id').trigger("change");
    });
    $('#youSendCurrency').trigger("change");

    $('#pledgeAuto').hide();
    $('#initialising_date').removeAttr('required');

    $(".choiceClass") // select the radio by its id
    .change(function(){ // bind a function to the change event
        if( $(this).is(":checked") ){ // check if the radio is checked
            var choice = $(this).val(); // retrieve the value
            if(choice==2 || choice==1){
              $('#pledgeAuto').show();
              $('#initialising_date').attr('required', 'required');
            }else{
              $('#pledgeAuto').hide();
              $('#initialising_date').removeAttr('required');
            }
        }
    });

</script>
</body>
</html>