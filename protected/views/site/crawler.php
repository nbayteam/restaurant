<?php

?>
<script type="text/javascript">
var DISTRICT = [    'jurong+east',

    'bukit+batok',

    'bukit+gombak',

    'choa+chu+kang',

    'yew+tee',

    'kranji',

    'marsiling',

    'woodlands',

    'admiralty',

    'sembawang',

    'yishun',

    'khatib',

    'yi+chu+kang',

    'ang+mo+kio',

    'bishan',

    'braddel',

    'toa+payoh',

    'novena',

    'newton',

    'orchard',

    'somerset',

    'dhoby+ghaut',

    'city+hall',

    'raffles+place',

    'marina+bay'

    ];



function genGoogleLink(district){

    var link = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=restaurant+in+"+district+"+singapore&types=food&sensor=true&key=AIzaSyCvfQsV6uGOSqj8pbRTbU9K5MP3Myjh98c";

    return link;

}

$(document).ready(function(){

    for (var i=0; i<DISTRICT.length; i++) {

        var districtName = DISTRICT[i];

        console.log('crawling data in district: '+districtName);

        var link = genGoogleLink(districtName);

        var ajaxOptions = {

            url: link,

            type: 'GET',

            dataType: 'json',

            success: function (data, textStatus, jqXHR){

                console.log('success');

                console.log(data);

            }

        };

        var ajaxRequest = $.ajax(ajaxOptions);

        ajaxRequest.fail(function(){

            console.log('Error on Google Place request');

        });

    }



});



</script>