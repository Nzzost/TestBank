$(document).ready(function(){

// on init values
    var showingSearchMobile = false;
    var showingSearch       = false;
    var tabValue            = 'upcoming';
    var categoryValue       = null;
    var sendObj             = {}

    sendObj.category        = null;
    sendObj.tab             = 'upcoming';
    sendObj.search          = null;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('#token').attr('data') } });


        var barsValue = function(){

            $( "div[data-bar]" ).each(function( i ) {
                var value = +$( this ).attr( "data-bar" );
                if (sendObj.tab == 'finished') return;
                var thisData = $( this ).attr( "data-bar" ) + '%';
                $( this ).css( "width", thisData );

                if ( value < "33" ) {
                  this.style.backgroundColor = "#00cea9";
                } else if ( value >= "33" && value <= "66" ){
                  this.style.backgroundColor = "#fda03c";
                } else if ( value >= "66" ){
                  this.style.backgroundColor = "#fb3c4f";
                }
            });

            $( "div[data-bar2]" ).each(function( i ) {
                var value = +$( this ).attr( "data-bar2" );
                if (sendObj.tab == 'finished') return;
                var thisData = $( this ).attr( "data-bar2" ) + '%';
                $( this ).css( "width", thisData );

                if ( value < "98" ) {
                    this.style.backgroundColor = "#00cea9";
                } else if ( value >= "98" ){
                    this.style.backgroundColor = "#fb3c4f";
                }
            });
        }

        barsValue();

    var postQuery           = function () {
        
        $.post( "/_getICOsForMainPage", sendObj, function(data) {
            
            var table = '';
            // for select all categories
            var categoryLi = "<li>All</li>";

            if (data['category']) {
                for (var i = 0; i < data['category'].length; i++) {
                    categoryLi += "<li data-category = '"+data.category[i]+"'>" +data.category[i]+ "</li>";            
                }  
                $(".categories").html(categoryLi);
                categoryList();
            }
            var arr = data['icos'];
                
            if (arr.length) {                
                data['icos'].forEach(function(value,index) {
                table += "<tr class = 'row-element'>" +

                    "<td class = 'first-cell'>"+
                    "<span class='img hidden-md-down'>";
                if (value['ico'].icon.substr(0,4) == 'data' || value['ico'].icon.substr(0,4) == 'http') {
                    table += "<img src='"+value['ico'].icon+"'>";
                } else {
                    table += "<img src='https://www.cryptovest.com/"+value['ico'].icon+"'>";
                }
                table += "</span>" +
                    "<a href = 'https://www.cryptovest.com/"+value['ico'].url+"'>" +value['ico'].title +
                    "</a>";
                if (value['ico'].medal) {
                    table += "<span class='star'>"+
                        "<img src='"+value['ico'].medal+"'>" +
                        "</span>";
                }
                if (value['ico'].is_featch) {
                    table += "<span class='featured'>Featured</span>";
                }

                table += "</td>" +
                    "<td>" + value['ico'].category +
                    "</td>" +
                    "<td>" + value['ico'].data + " UTC </td>" +
                    "<td class = 'time-bar'>" ;
                    if (value['diff'].diff == '0 d 00:00:00') {
                        table += "<span class = 'time'> Waiting for data </span>" ;
                    } else {
                        table += "<span class = 'time'>" + value['diff'].diff + "</span>";
                    }
                    table += "<div class='progress'>" +
                    "<div class='bar' data-bar = '"+value['diff'].percent+"'>" +
                    "</div>" +
                    "</div>"+
                    "</td>"+
                    "</tr>";
            });
                $("#main-table-icos").html(table);
            } else if (arr.length == undefined) {

                sendObj.tab = data['icos'].diff.tab;                

                $( ".tab-element" ).each(function( i ) {

                    if ($( this ).attr( "data-tab-value" ) == sendObj.tab) {
                        $( this ).addClass('active');
                    }                     
                        
                        if (sendObj.tab == 'finished') {
                            $('.main-list thead tr th:last').text('RAISED');
                            $('.main-list thead tr th:nth-child(3)').text('END DATE');
                        } else if (sendObj.tab == 'upcoming') {
                            $('.main-list thead tr th:nth-child(3)').text('START DATE');
                            $('.main-list thead tr th:last').text('STARTS IN');
                        } else if (sendObj.tab == 'live') {
                            $('.main-list thead tr th:last').text('ENDS IN');

                            $('.main-list thead tr th:nth-child(3)').text('START DATE');
                        }                                               
                    
                    $( ".tab-element" ).each(function( i ) {

                        ($( this ).attr( "data-tab-value" ) == sendObj.tab)? $( this ).addClass('active') : $( this ).removeClass('active');

                    });

                });

                table += "<tr class = 'row-element'>" +

                    "<td class = 'first-cell'>"+
                    "<span class='img hidden-md-down'>";
                if (data['icos'].ico.icon.substr(0,4) == 'data' || data['icos'].ico.icon.substr(0,4) == 'http') {
                    table += "<img src='"+data['ico'].icon+"'>";
                } else {
                    table += "<img src='https://www.cryptovest.com/"+data['icos'].ico.icon+"'>";
                }
                table += "</span>" +
                    "<a href = 'https://www.cryptovest.com/"+data['icos'].ico.url+"'>" +data['icos'].ico.title +
                    "</a>";
                if (data['icos'].ico.medal) {
                    table += "<span class='star'>"+
                        "<img src='"+data['icos'].ico.medal+"'>" +
                        "</span>";
                }
                if (data['icos'].ico.is_featch) {
                    table += "<span class='featured'>Featured</span>";
                }

                table += "</td>" +
                    "<td>" + data['icos'].ico.category +
                    "</td>" +
                    "<td>" + data['icos'].ico.data + " UTC </td>" +
                    "<td class = 'time-bar'>" ;
                    if (data['icos'].diff.diff == '0 d 00:00:00') {
                        table += "<span class = 'time'> waiting for data </span>" ;
                    } else {
                        table += "<span class = 'time'>" + data['icos'].diff.diff + "</span>";
                    }
                    table += "<div class='progress'>" +
                    "<div class='bar' data-bar = '"+data['icos'].diff.percent+"'>" +
                    "</div>" +
                    "</div>"+
                    "</td>"+
                    "</tr>";

                    $("#main-table-icos").html(table);
                
            } else {

                $("#main-table-icos").html('no results');
            }
            
           barsValue(); 
        });
    }

    // show search input

    var searchInput                 = $("#search")[0];
    searchInput.style.display       = 'none';
    var searchInputMobile           = $("#search-mobile")[0];
    searchInputMobile.style.display = 'none';

    $("#show-search").on( "click", function() {
        showingSearch = !showingSearch;
        if (showingSearch) {
            searchInput.style.display = 'inline-block';
        } else {
            searchInput.style.display = 'none';
        }
    });

    $("#show-search-mobile").on( "click", function() {
        showingSearchMobile = !showingSearchMobile;

        if (showingSearchMobile) {
            searchInputMobile.style.display = 'inline-block';
        } else {
            searchInputMobile.style.display = 'none';
        }
    });


    // get category values
    
    var categoryList = function() {
            $(".dropdown-menu.categories li").each(function( i ) {
                var changeText = 'Category'
                $( this ).on( "click", function() {
                    
                    sendObj.category = $( this ).attr( "data-category" );
                    changeText = $( this ).text();
                    $( ".categories-dropdown" )[0].innerHTML = changeText;
                    $( ".categories-dropdown" )[1].innerHTML = changeText;
                    postQuery();
                });
            });
    }
    categoryList();

    // get tab values
    $( ".tab-element" ).each(function( i ) {

        if ($( this ).attr( "data-tab-value" ) == tabValue) {
            $( this ).addClass('active');
        }
        $(this).on( "click", function() {
            
            sendObj.tab = $( this ).attr( "data-tab-value" );
            if (sendObj.tab == 'finished') {
                $('.main-list thead tr th:last').text('RAISED');
                $('.main-list thead tr th:nth-child(3)').text('END DATE');
            } else if (sendObj.tab == 'upcoming') {
                $('.main-list thead tr th:nth-child(3)').text('START DATE');
                $('.main-list thead tr th:last').text('STARTS IN');
            } else if (sendObj.tab == 'live') {
                $('.main-list thead tr th:last').text('ENDS IN');

                $('.main-list thead tr th:nth-child(3)').text('START DATE');
            }            

            postQuery();
            $( ".tab-element" ).each(function( i ) {

                ($( this ).attr( "data-tab-value" ) == sendObj.tab)? $( this ).addClass('active') : $( this ).removeClass('active');

            });
            
        });

    });

    // get search value from input
    $( ".searching-inputs" ).on( "keyup", function() {
        if ($(this).val() == '') {
            sendObj.search = null;
        } else {
            sendObj.search = $(this).val();
        }
        postQuery();        
    } )



    // for countdown new function
    var showclock = function() {
        var fieldDate=$(".countdown").data('date').split('-');

        var seconds= +fieldDate[0] * 86400 + +fieldDate[1] * 3600 + +fieldDate[2] * 60 + +fieldDate[3];

        function changeTime() {

            var over = seconds;
            var days=Math.floor(over/86400);
            over=over%86400;
            
            var hours=Math.floor(over/3600);
            over=over%3600;

            var minutes=Math.floor(over/60);
            over=Math.floor(over%60);

            var html="";
           
            html+="<div class='countdown-container days'>"
                html+="<span class='countdown-heading days-top'>Days</span>";
                html+="<span class='countdown-value days-bottom'>"+days+"</span>";
            html+="</div>";
        
            html+="<div class='countdown-container hours'>"
                html+="<span class='countdown-heading hours-top'>Hours</span>";
                html+="<span class='countdown-value hours-bottom'>"+hours+"</span>";
            html+="</div>";

            html+="<div class='countdown-container minutes'>"
                html+="<span class='countdown-heading minutes-top'>Minutes</span>";
                html+="<span class='countdown-value minutes-bottom'>"+minutes+"</span>";
            html+="</div>";

            html+="<div class='countdown-container seconds'>"
                html+="<span class='countdown-heading seconds-top'>Seconds</span>";
                html+="<span class='countdown-value seconds-bottom'>"+over+"</span>";
            html+="</div>";

            $(".countdown").html(html);
        } 
        
        // $(".countdown").html(html);       

        setInterval(function(){
            seconds = seconds - 1;        
            changeTime();        
        },1000);
    }

    showclock();











});

// pagination
$(window).on('load', function() {
    var ias = jQuery.ias({
        container:  '#container',
        item:       '.row-element',
        pagination: '#pagination',
        next:       '#pagination a[rel=next]'
    });

    ias.extension(new IASSpinnerExtension({src: '/images/svg/metaball-subscriptions.svg'}));
    ias.extension(new IASTriggerExtension({offset: 200}));
    ias.extension(new IASNoneLeftExtension({text: "You reached the end"}));
    ias.extension(new IASPagingExtension());
    ias.extension(new IASHistoryExtension({prev: '#pagination a[rel=prev]'}));


});
