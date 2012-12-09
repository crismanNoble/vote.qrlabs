<?php
//connect to database
//include_once 'APW_functions.php';
include_once 'connections.php';
//$connection = APW_Prepare_DB();

//Grab thing
$thing = $_GET["thing"];
//grab thing direction

//grab info about the user?
$user = $_SERVER['HTTP_USER_AGENT'];
$user = $user.$_SERVER['REMOTE_ADDR'];

//add vote into votes table
$sql = "INSERT INTO `angelaj2_qrvotes`.`votes` (`thing`, `user`) VALUES ('$thing', '$user');";

?>

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
      <p>Your Vote:&nbsp;<?php $thing ?></p>
      <hr />
    </div>
  </div>
  <div class="row">
    <div class="four columns" id="setup">
      <h3 id="setupToggle">Setup</h3>
      <div id="setupVars">
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
      <a class="button" href="#" id="save">Save</a>
      </div>

    </div>
    <div class="four columns" id="fighter1">
      <center><h3><span id="thing1Name" class="heading">Thing 1</span></h3></center>
      <img src="http://placehold.it/400x400&text=Enter+Thing1+Title" id="thing1Output" class="genQR">
      <a href="#" id="thing1Link" class="thingLink"></a>
      <center>
        <span id="thing1Value" class="count"></span>
      </center>
    </div>
    <div class="four columns" id="fighter2">
      <center><h3><span id="thing2Name" class="heading">Thing 2</span></h3></center>
      <img src="http://placehold.it/400x400&text=Enter+Thing2+Title"  id="thing2Output" class="genQR">
     
      <a href="#" id="thing2Link" class="thingLink"></a>
      <center>
        <span id="thing2Value" class="count"></span>
      </center>
      
    </div>

  </div>
  <div class="row">
    <center>
    <div class="eight columns offset-by-four" style="margin-top:20px;" id="pieWrap">
      
    </div>
  </center>
  </div>
  
  
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/foundation.min.js"></script>
  <script src="http://mbostock.github.com/d3/d3.js"></script>

  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>

  <script>
  $(document).ready(function() {
    determineFighters();

    intervals = setInterval(determineCounts, 1000);

    $('#color1, #color2').val('000000');

    $('#thing1').keyup(function(){
      generateQR('1');
      generateQRTitle('1');
      updateURL();
    });
    $('#color1').keyup(function(){
      generateQR('1');
    });

    $('#thing2').keyup(function(){
      generateQR('2');
      generateQRTitle('2');
      updateURL();
    });
    $('#color2').keyup(function(){
      generateQR('2');
    });

    $('#setupToggle').click(function(){
      if($(this).hasClass('small')){
        showSetup();
      } else {
        hideSetup();
      }
    });

    $('#save').click(function(){
      updateURL();
    });

  });

  var fighter1 = false;
  var fighter2 = false;



  function generateQR(who) {
    var thing= '#thing' + who;
    thing = $(thing).val();

    var color = '#color' + who;
    color = $(color).val();

    var thisURL = window.location.href.split('?')[0];
    var url = thisURL + '?thing=' + thing;
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

  function determineFighters(){

    var hashString = document.location.hash;
    if (!hashString){
      prepareFight();
    } else {
      var fighterList = hashString.split('#')[1].split('&');

      fighter1 = decodeURIComponent(fighterList[0]);
      fighter2 = decodeURIComponent(fighterList[1].split('?')[0]);

      loadFight();
    }
  }

  function loadFight(){

    $('#thing1').val(fighter1);
    $('#thing2').val(fighter2);

    generateQRTitle(1);
    generateQRTitle(2);

    generateQR(1);
    generateQR(2);

    determineCount(1);
    determineCount(2);

    hideSetup();

  }

  function prepareFight(){
    $('.thingLink').hide();
  }

  function hideSetup(){
    $('#setupVars').hide();
    $('#setup').removeClass('four');
    $('#setup').addClass('two');
    $('#setupToggle').addClass('small');
    $('#fighter1').addClass('five');
    $('#fighter1').removeClass('four');
    $('#fighter2').addClass('five');
    $('#fighter2').removeClass('four');
    $('.thingLink').addClass('thingLink2');
    $('#pieWrap').removeClass('offset-by-four');
    $('#pieWrap').addClass('offset-by-two');
    $('#pieWrap').addClass('ten');
    $('#pieWrap').removeClass('eight');
  }

  function showSetup(){
    $('#setupVars').show();
    $('#setup').removeClass('two');
    $('#setup').addClass('four');
    $('#setupToggle').removeClass('small');
    $('#fighter1').addClass('four');
    $('#fighter1').removeClass('five');
    $('#fighter2').addClass('four');
    $('#fighter2').removeClass('five');
    $('.thingLink').removeClass('thingLink2');
    $('#pieWrap').addClass('offset-by-four');
    $('#pieWrap').removeClass('offset-by-two');
    $('#pieWrap').removeClass('ten');
    $('#pieWrap').addClass('eight');
  }

  function determineCounts(){
    determineCount(1);
    determineCount(2);
  }

  function determineCount(who){
    var which = '#thing' + who;
    var query = which + 'Name';
    query = $(query).text();
    var queryURL = 'nodes/voteCount.php?thing='+query

    $(which + 'Value').load(queryURL);
    drawChart();
  }

  function updateURL(){
    var which1 = '#thing' + 1;
    var query1 = which1 + 'Name';
    query1 = encodeURIComponent($(query1).text());

    var which2 = '#thing' + 2;
    var query2 = which2 + 'Name';
    query2 = encodeURIComponent($(query2).text());

    var baseURL = window.location.href.split('#')[0];

    var newURL = baseURL +'#' + query1 + '&' + query2;

    $('#save').attr('href', newURL);

  }

  function removeChart(){
    $('#pieWrap').find('svg').remove();
  }

  function drawChart(){
    removeChart();

    var score1 = parseInt($('#thing1Value').text());
    var score2 = parseInt($('#thing2Value').text());
    var title1 = $('#thing1Name').text();
    var title2 = $('#thing2Name').text();

    if (score1 == 0 && score2 == 0) {
      return false;
    }

    var w = 400, h = 400, r = 200, color = d3.scale.category20c();

    data = [{"label":title1, "value":score1},
            {"label":title2, "value":score2}
    ];

    var vis = d3.select('#pieWrap')
      .append("svg:svg")
      .data([data])
      .attr("width", w)
      .attr("height",h)
      .append("svg:g")
      .attr("transform", "translate(" + r + "," + r + ")");

    var arc = d3.svg.arc().outerRadius(r);
    var pie = d3.layout.pie().value(function(d){return d.value;});

    var arcs = vis.selectAll("g.slice")
      .data(pie)
      .enter()
        .append("svg:g")
        .attr("class", "slice");

    arcs.append("svg:path")
      .attr("fill", function(d, i){ return color(i);})
      .attr("d", arc);

    arcs.append("svg:text")
      .attr("transform", function(d) {
        d.innerRadius = 0;
        d.outerRadius = r;
        return "translate(" + arc.centroid(d) +")";
      })
      .attr("text-anchor","middle")
      .text(function(d, i) {
        return data[i].label; });

  };

  </script>
  <script>

  
  
</body>
</html>