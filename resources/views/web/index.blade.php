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
      <div class="header-row">
          <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo me-3"> <a class="d-flex" href="https://healingstreams.tv" title="Healing streams"><img src="images/logo.png" style="border-radius:10px;" alt="Payyed"/></a> </div>
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
            <h1 class="h1-text-style">GIVE NOW OR MAKE A PLEDGE</h1>
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
    
    <!-- Send Money
    ============================================= -->
    
    <!-- Send Money End --> 
    <div class="container body-container">
      <div class="bg-white rounded shadow-md p-4">
        <h3 class="text-5 mb-4 text-center">Registration</h3>
        <hr class="mb-4 mx-n4">
        <form id="form-send-money" method="post">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="mb-3">
                <label for="first_name" class="form-label">First name</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <label for="middle_name" class="form-label">Middle name</label>
              <div class="input-group">
                  <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle name">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email id" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label for="youSend" class="form-label">Phone no</label>
              <div class="input-group">
                  {{-- <span class="input-group-text p-0">
                    <select id="youSendCurrency" data-style="form-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control bg-transparent" required="">
                      <optgroup label="Popular Currency">
                        <option data-icon="currency-flag currency-flag-usd me-1" data-subtext="United States dollar" selected="selected" value="">USD</option>
                        <option data-icon="currency-flag currency-flag-aud me-1" data-subtext="Australian dollar" value="">AUD</option>
                        <option data-icon="currency-flag currency-flag-inr me-1" data-subtext="Indian rupee" value="">INR</option>
                      </optgroup>
                      <option data-divider="true"></option>
                        <optgroup label="Other Currency">
                        <option data-icon="currency-flag currency-flag-aed me-1" data-subtext="United Arab Emirates dirham" value="">AED</option>
                        <option data-icon="currency-flag currency-flag-ars me-1" data-subtext="Argentine peso" value="">ARS</option>
                        <option data-icon="currency-flag currency-flag-aud me-1" data-subtext="Australian dollar" value="">AUD</option>
                        <option data-icon="currency-flag currency-flag-bdt me-1" data-subtext="Bangladeshi taka" value="">BDT</option>
                        <option data-icon="currency-flag currency-flag-bgn me-1" data-subtext="Bulgarian lev" value="">BGN</option>
                        <option data-icon="currency-flag currency-flag-brl me-1" data-subtext="Brazilian real" value="">BRL</option>
                        <option data-icon="currency-flag currency-flag-cad me-1" data-subtext="Canadian dollar" value="">CAD</option>
                        <option data-icon="currency-flag currency-flag-chf me-1" data-subtext="Swiss franc" value="">CHF</option>
                        <option data-icon="currency-flag currency-flag-clp me-1" data-subtext="Chilean peso" value="">CLP</option>
                        <option data-icon="currency-flag currency-flag-cny me-1" data-subtext="Chinese yuan" value="">CNY</option>
                        <option data-icon="currency-flag currency-flag-czk me-1" data-subtext="Czech koruna" value="">CZK</option>
                        <option data-icon="currency-flag currency-flag-dkk me-1" data-subtext="Danish krone" value="">DKK</option>
                        <option data-icon="currency-flag currency-flag-egp me-1" data-subtext="Egyptian pound" value="">EGP</option>
                        <option data-icon="currency-flag currency-flag-eur me-1" data-subtext="Euro" value="">EUR</option>
                        <option data-icon="currency-flag currency-flag-gbp me-1" data-subtext="British pound" value="">GBP</option>
                        <option data-icon="currency-flag currency-flag-gel me-1" data-subtext="Georgian lari" value="">GEL</option>
                        <option data-icon="currency-flag currency-flag-ghs me-1" data-subtext="Ghanaian cedi" value="">GHS</option>
                        <option data-icon="currency-flag currency-flag-hkd me-1" data-subtext="Hong Kong dollar" value="">HKD</option>
                        <option data-icon="currency-flag currency-flag-hrk me-1" data-subtext="Croatian kuna" value="">HRK</option>
                        <option data-icon="currency-flag currency-flag-huf me-1" data-subtext="Hungarian forint" value="">HUF</option>
                        <option data-icon="currency-flag currency-flag-idr me-1" data-subtext="Indonesian rupiah" value="">IDR</option>
                        <option data-icon="currency-flag currency-flag-ils me-1" data-subtext="Israeli shekel" value="">ILS</option>
                        <option data-icon="currency-flag currency-flag-inr me-1" data-subtext="Indian rupee" value="">INR</option>
                        <option data-icon="currency-flag currency-flag-jpy me-1" data-subtext="Japanese yen" value="">JPY</option>
                        <option data-icon="currency-flag currency-flag-kes me-1" data-subtext="Kenyan shilling" value="">KES</option>
                        <option data-icon="currency-flag currency-flag-krw me-1" data-subtext="South Korean won" value="">KRW</option>
                        <option data-icon="currency-flag currency-flag-lkr me-1" data-subtext="Sri Lankan rupee" value="">LKR</option>
                        <option data-icon="currency-flag currency-flag-mad me-1" data-subtext="Moroccan dirham" value="">MAD</option>
                        <option data-icon="currency-flag currency-flag-mxn me-1" data-subtext="Mexican peso" value="">MXN</option>
                        <option data-icon="currency-flag currency-flag-myr me-1" data-subtext="Malaysian ringgit" value="">MYR</option>
                        <option data-icon="currency-flag currency-flag-ngn me-1" data-subtext="Nigerian naira" value="">NGN</option>
                        <option data-icon="currency-flag currency-flag-nok me-1" data-subtext="Norwegian krone" value="">NOK</option>
                        <option data-icon="currency-flag currency-flag-npr me-1" data-subtext="Nepalese rupee" value="">NPR</option>
                        <option data-icon="currency-flag currency-flag-nzd me-1" data-subtext="New Zealand dollar" value="">NZD</option>
                        <option data-icon="currency-flag currency-flag-pen me-1" data-subtext="Peruvian nuevo sol" value="">PEN</option>
                        <option data-icon="currency-flag currency-flag-php me-1" data-subtext="Philippine peso" value="">PHP</option>
                        <option data-icon="currency-flag currency-flag-pkr me-1" data-subtext="Pakistani rupee" value="">PKR</option>
                        <option data-icon="currency-flag currency-flag-pln me-1" data-subtext="Polish złoty" value="">PLN</option>
                        <option data-icon="currency-flag currency-flag-ron me-1" data-subtext="Romanian leu" value="">RON</option>
                        <option data-icon="currency-flag currency-flag-rub me-1" data-subtext="Russian rouble" value="">RUB</option>
                        <option data-icon="currency-flag currency-flag-sek me-1" data-subtext="Swedish krona" value="">SEK</option>
                        <option data-icon="currency-flag currency-flag-sgd me-1" data-subtext="Singapore dollar" value="">SGD</option>
                        <option data-icon="currency-flag currency-flag-thb me-1" data-subtext="Thai baht" value="">THB</option>
                        <option data-icon="currency-flag currency-flag-try me-1" data-subtext="Turkish lira" value="">TRY</option>
                        <option data-icon="currency-flag currency-flag-uah me-1" data-subtext="Ukrainian hryvnia" value="">UAH</option>
                        <option data-icon="currency-flag currency-flag-ugx me-1" data-subtext="Ugandan shilling" value="">UGX</option>
                        <option data-icon="currency-flag currency-flag-vnd me-1" data-subtext="Vietnamese dong" value="">VND</option>
                        <option data-icon="currency-flag currency-flag-zar me-1" data-subtext="South African rand" value="">ZAR</option>
                      </optgroup>
                    </select>
                  </span> --}}
                  <input type="number" class="form-control" data-bv-field="phone_no" id="phone_no" placeholder="Phone no" required>
              </div>
            </div>
          </div><br>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <label for="partnership_categories" class="form-label">Partnership categories</label>
                <div class="input-group">
                  <select name="partnership_categories" id="partnership_categories" class="form-select" multiple="multiple" required>
                      <option value="">Select your category</option>
                      <option value="1">Healing Streams TV</option>
                      <option value="2">Healing To The Nations Magazine</option>
                      <option value="3">Translations</option>
                      <option value="4">Medical Outreaches</option>
                      <option value="5">Community Clinics</option>
                      <option value="6">Youth Programs</option>
                      <option value="7">Youth TV</option>

                  </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <label for="country" class="form-label">Country</label>
                <div class="input-group">
                  <select name="country" id="country" class="form-select" required>
                      <option value="">Select your country</option>
                      @foreach ($countries as $item)
                          <option value="{{$item->id}}">{{$item->country}}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <label for="currency" class="form-label">Currency</label>
                <div class="input-group">
                  <select name="currency" id="currency" class="form-control" required>
                      <option value="">Select your currency</option>
                  </select>
                </div>
            </div>
          </div><br>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="amount" class="form-label">Amount</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="row" style="padding-top:40px;">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <input type="radio" id="html" name="fav_language" value="HTML" checked>
                      <label for="html">One off</label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <input type="radio" id="css" name="fav_language" value="CSS">
                      <label for="css">Monthly automatic</label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                      <label for="javascript">Make a pledge</label>
                  </div>
              </div>
            </div>
          </div>
          <p> </p>
          <div align="right"><button class="btn btn-primary">Continue</button></div>
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
    $('#country').change(function(){
      var id=$(this).val();
      var url= "{{route('currencies.list','ID')}}";
      url=url.replace('ID',id);
      $.ajax({
          url: url,
          type:"get",
          success:function(response){
              var list = $("#currency");
              list.empty()
              list.append(new Option("Select your currency", ""));
              $.each(response, function(index, item) {
                var text = item.currency + "(" + item.currency_symbol + ")";
                list.append(new Option(text, item.id));
              });
          },
      });
    });
</script>
</body>
</html>