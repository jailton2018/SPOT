<?php
$this->assign('title', 'SPOT | Production Scheduling');
$this->assign('nav', 'pmon');

$this->display('_Header.tpl.php');
?>

<style>
    .Maincontainer {
        position: relative;
        top : -50px;

    }
    table {
        width: 100%;
        display: block;
    }
    table td {
        width : 600px;
    }
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }

    .rotation-container {
        position: relative;
        width:  100%;
        height: 140px;
        margin: 0 auto;
    }
    .rotation-container ul {
        list-style-type: none;
        padding: 0;
    }
    .rotation-container .badge {
        width: 80%
    }
    .rotation-viewport {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    .rotation-list {
        margin: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .rotation-list li {
        position: absolute;
        margin: 0;
        line-height: 1.4em;
        clear: none;
        height: 100%;
        width: 100%;
    }
    .rotation-nav-controls .rotation-item {
        position: absolute;
        z-index: 1000;
        bottom: -5%;
        width: 5%;

    }
    .rotation-nav-controls .rotation-prev {

        left: 5%;
    }
    .rotation-nav-controls .rotation-next {

        right: 5%;
    }

    .rotation-pagination li {
        display: inline-block;
        margin: 6px;
    }
    .rotation-pagination li a {
        display: block;
        width: 100%;
        height: 100%;
    }


    .carousel-indicators li {
        display: inline-block;
        width: 24px;
        height: 24px;
        margin: 5px;
        text-indent: 0;
        text-align: center;
        font-weight: bold;
        color: #FFFFFF;
        cursor: pointer;
        border: none;
        border-radius: 50%;
        background-color: #0000ff;
        box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5);    
    }
    .carousel-indicators .active {
        width: 24px;
        height: 24px;
        margin: 5px;
        background-color: #ffff99;
        color: #00F3B3;
    }

    .backgroundYellow{
        background: yellow;
    }

</style>

<script src="scripts/jquery.rotation.min.js"></script>

<script>
    $('document').ready(function () {
        $('body').css('overflow', 'hidden')
        var style = $('<style>.Hosts { width : 30%; }</style>');
        $('html > head').append(style);
        $('.navbar').hide();
        $('.container').remove();
        function getContrast50(hexcolor) {
            return (parseInt(hexcolor, 16) > 0xffffff / 2) ? 'black' : 'white';
        }

        function getContrastYIQ(hexcolor) {
            var r = parseInt(hexcolor.substr(0, 2), 16);
            var g = parseInt(hexcolor.substr(2, 2), 16);
            var b = parseInt(hexcolor.substr(4, 2), 16);
            var yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
            return (yiq >= 128) ? 'black' : 'white';
        }


        //check if HQ servers  are all alive before to continue
        var sysproddb = 'sysproddb.my.compnay.com';
        var sharepoint = "sharepoint.my.compnay.com";
        var myself = "spmgt.my.compnay.com";
        var servers = {
            0: sysproddb,
            1: sharepoint,
            2: myself

        };
        var serializedData = JSON.stringify(servers);
        $.ajax({
            url: "includes/ping.php",
            type: "post",
            data: 'hosts=' + serializedData,
            cache: false,
            async: true,
            beforeSend: function (data) {
                $('.alive').html('Checking Sysprod Servers recheability   <img src="/SPOT/provisioning/images/loader.gif" />');
            },
            success: function (data) {

                var alive = JSON.parse(data);
                var html = '';
                for (var key in alive) {
                    if (alive.hasOwnProperty(key)) {
                        html = html + ' ' + alive[key];
                    }
                }

                $('.alive').html(html);
                /*
                 * Take the sharepoint values
                 */
                $('#success').html('Retreiving "Sales Orders" orders from Sysproddb. Please, be patient.&nbsp;  <img src="/SPOT/provisioning/images/loader.gif" class="pull-right" />').show();
                (function update() {
                    $('#success').html('Retreiving "Sales Orders" orders from Sysproddb. Please, be patient.&nbsp;  <img src="/SPOT/provisioning/images/loader.gif" class="pull-right" />').show();
                    $.ajax({
                        url: '/SPOT/provisioning/includes/sysproddbWrapper.php',
                        dataType: 'json',
                        methos: 'GET',
                        cache: false,
                        async: true,
                        success: function (data) {

                            var jsonobj = data;
                            //   console.log(jsonobj);
                            $('#success').hide();
                            var tbl = $('#sysproddb');
                            var table = '';
                            var td = '<tbody>';
                            var bgcolor_num = '';
                            $.each(jsonobj, function (index, item) {

                                var jcell = item;
                                bgcolor_num = item.bgcolor;
                                var bgcolor = '#' + bgcolor_num.toString(16)
                                var font = "style='color:" + getContrastYIQ(bgcolor_num.toString(16)) + "'";
                                var th = '';
                                td += '<tr bgcolor="' + bgcolor + '" class="' + bgcolor_num + ' items details">';
                                for (var key in jcell) {
                                    if (jcell.hasOwnProperty(key)) {
                                        var header = key.replace(/([a-z])([A-Z])/g, "$1 $2");
                                        if (header !== "bgcolor") {
                                            th += '<th class="' + header + '">' + header + '</th>';
                                            if (typeof jcell[key] === 'undefined' || jcell[key] == null) {
                                                jcell[key] = '';
                                            }



                                            td += '<td ' + font + ' data-attr="' + key + '" id="' + index + '_' + key + '" class="' + header + '"><strong>' + jcell[key] + '</strong></td>';
                                        }

                                    }
                                    // console.log(jcell[key]);
                                }
                                table = '<thead><tr>' + th + '</tr></thead>';
                                td += '</tr>';
                            });
                            table += td + '</tbody>';
                            if (table !== '') {
                                tbl.html(table);
                                $('.data').tooltip();
                                // Logic to add click action
                                $('.data').on('click', function () {
                                    var trid = $(this).attr('id');
                                    var data = $("#" + trid).map(function (index, elem) {
                                        var json = {};
                                        $('.inputValue', this).each(function () {
                                            var d = $(this).val() || $(this).text();
                                            var tdkey = $(this).attr('data-attr');
                                            json[tdkey] = d;
                                        });
                                        //Call the function to load
                                        //console.log(json.SharepointLink);

                                    });
                                });

                            } else
                            {
                                $('#servermsg').html('<strong>No data retreived.</strong>');
                                $('#basicModal').modal();
                            }
                        },
                        error: function (xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            $('#failed').html('An error occured checking HQ servers. The errors reported:' + err + ' - ' + error);
                            $('#success').hide();
                            $('#failed').show();
                        }
                    }).then(function () {


                        $(".rotation").rotation({
                            autoRotate: true,
                            pagination: false,
                            interval: 3000,
                            duration: 1000,
                        });
                        setTimeout(update, 120000); // function refers to itself
                        startFlashing();
                    });
                })();
                function startFlashing() {
                    //$('.3858176').effect("highlight", {color: 'yellow'}, 500, startFlashing);
                    // $('.3858176').effect("bounce", "slow");

                    setInterval(function () {
                        $('.3858176').toggleClass('backgroundYellow');
                    }, 1000);
                }
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                $('#failed').html('An error occured checking HQ servers. The errors reported:' + err + ' - ' + error);
                $('#success').hide();
                $('#failed').show();
            }
        });



    });
</script>

<div class="Maincontainer">

    <center>
        <!-- <button class="btn btn-success go">Start Automatic Scrolling</button>
         <button class="btn btn- stop">Stop Automatic Scrolling</button> -->
        <i class="icon-th-list"></i> <?php echo $this->title; ?> 
    <!--    <span id=loader class="loader progress progress-striped active"><span class="bar"></span></span> -->
        <time class=" badge badge-info"></time>

        <span  class="alive text-info text-right pull-left" ></span>
        <span id="count" class="badge badge-inverse"></span>

    </center>



    <!-- underscore template for the collection -->
    <!-- <h2 class="alert alert-info" role="alert"><i class="icon-cloud"></i> Sharepoint "Scheduled" Orders</h2>-->
    <!-- underscore template for the collection -->


    <div class="alert alert-success" id="success" role="alert" style="display:none"></div>
    <div class="alert alert-danger" id="failed" role="alert" style="display:none"></div>
    <input type="hidden" id="username" value="<?php if (isset($_SESSION['login'])) echo $_SESSION['login']; ?>" />


    <div id="carousel">

    </div>

    <table class="table table-bordered table-responsive" id="sysproddb">








    </table>
   <!--  <span class="alive text-info text-right pull-right" ></span>

   <center>
        <button class="btn btn-success go">Start Automatic Scrolling</button>
        <button class="btn btn- stop">Stop Automatic Scrolling</button>
        <i class="icon-th-list"></i> <?php echo $this->title; ?> <time class=" badge badge-info"></time>
     

    </center> -->


</div> 


</body>
</html>

<script>
    $(document).ready(function () {
        var timer1;
        var interval;
        var timer2;
        $(".go").hide();
        //$(".stop").hide();
        $(".go").click(function () {
            location.reload();
        });

// Stop animation when button is clicked
        $(".stop").click(function () {
            $("html, body").stop();
            clearTimeout(timer1)
            clearInterval(interval);
            clearTimeout(timer2);

            $(".go").show();
            $(".stop").hide();
        });
        // Commented out because, the scroll has been implemented in a more elegant way 
        //scrollPage();


        function scrollPage() {

            $("html, body").animate({scrollTop: $(document).height()}, 16000);
            timer1 = setTimeout(function () {
                $('html, body').animate({scrollTop: 0}, 16000);
            }, 16000);
            interval = setInterval(function () {
                // 4000 - it will take 4 secound in total from the top of the page to the bottom
                $("html, body").animate({scrollTop: $(document).height()}, 16000);
                timer2 = setTimeout(function () {
                    $('html, body').animate({scrollTop: 0}, 16000);
                }, 16000);
            }, 16000);

        }
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('time').html(h + ":" + m + ":" + s);
        }
        setInterval(startTime, 1000);
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            // add zero in front of numbers < 10
            return i;
        }
        var myCarousel = $("#carousel");




        function moveRows(index) {

            myCarousel.html("<ol class='carousel-indicators'></ol>");
            var indicators = $(".carousel-indicators");
            var i = 0;
            $('#sysproddb > tbody  > tr').each(function () {
                ++i;
                var active;
                if (i == index) {
                    active = "class='active'";
                } else {
                    active = "class=''";
                }
                $('<li data-target="#carousel-example-generic" data-slide-to="' + i + '" ' + active + '>' + i + '</li>').appendTo(indicators);
            });
            var firstTR = $('tbody tr').first();
            firstTR.animate({opacity: 0},
            function () {
                $('tbody').append(firstTR);
            });
            firstTR.animate({opacity: 1});
        }
        var count = 0;

        setInterval(function () {
            var $slides = $('#sysproddb tbody tr');
            var index = ++count;
            var total = $slides.length;
            if (total == 0) {
              $("#count").html('No schedules found');
            return;
            }
            if (index == total)
                count = 0;

            $("#count").html('First row is  n. ' + index + ' of ' + total);

            moveRows(index);
        }, 5000);

    });
</script>

<?php
$this->display('_Footer.tpl.php');
?>
