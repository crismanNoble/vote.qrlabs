<!DOCTYPE html>

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width" />

  <title>Vote | QR Labs</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/app.css">

  <script src="javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>

  <div class="row">
    <div class="twelve columns">
      <h2>QR Votes</h2>
      <p>Because why not?</p>
      <hr />
    </div>
  </div>
  <div class="row">
    <div class="four columns">
      <h3>Setup</h3>

      <label for="thing1">Thing 1:</label>
      <input type="text" id="thing1"/>

      <label for="color1">Color 1:</label>
      <input type="text" id="color1"/>

      <hr />

      <label for="thing2">Thing 2:</label>
      <input type="text" id="thing2"/>

      <label for="color2">Color 2:</label>
      <input type="text" id="color2"/>

      <hr />
      <a class="button" href="#">Save</a>

    </div>
    <div class="four columns">
      <h3><span id="thing1Name">Thing 1</span></h3>
      <img src="http://placehold.it/400x400&text=Enter+Thing1+Title" id="thing1Output" class="genQR">
      <a href="#" id="thing1Link" class="thingLink"></a>
    </div>
    <div class="four columns">
      <h3><span id="thing2Name">Thing 2</span></h3>
      <img src="http://placehold.it/400x400&text=Enter+Thing2+Title"  id="thing2Output" class="genQR">
     
      <a href="#" id="thing2Link" class="thingLink"></a>
      
    </div>
  </div>
  
  
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>

  <script>
  $(document).ready(function() {


    $('#color1, #color2').val('000000');

    $('.thingLink').hide();


    $('#thing1').keyup(function(){
      generateQR('1');
      generateQRTitle('1');
    });
    $('#color1').keyup(function(){
      generateQR('1');
    });

    $('#thing2').keyup(function(){
      generateQR('2');
      generateQRTitle('2');
    });
    $('#color2').keyup(function(){
      generateQR('2');
    });

  });

  function generateQR(who) {
    var thing= '#thing' + who;
    thing = $(thing).val();

    var color = '#color' + who;
    color = $(color).val();

    var url = 'http://crisnoble.com/qrlabs/nodes/thingVote.php?thing=' + thing;
    var urlEncoded=encodeURIComponent(url);

    var kaywa_src = 'http://qrcode.kaywa.com/img.php?b='+color+'&w=FFFFFF&s=SIZE&t=p&d='+urlEncoded;

    var link = '#thing' + who + 'Link';
    $(link).show();
    $(link).text('Vote Here');
    $(link).attr('href',url);

    $('#thing' + who + 'Output').attr('src',kaywa_src);

  }

  function generateQRTitle(who) {
    var title = '#thing' + who + 'Name';
    var thing = '#thing' + who;

    thing = $(thing).val();

    $(title).text(thing);
  }


  </script>
  
</body>
</html>
