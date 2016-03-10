@extends('Centaur::layout')
@section('title', 'Dashboard')
@section('content')
 <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
        #map-canvas {
            min-height: 50vh;
        }
    </style>
    <script type="text/javascript">
        var markersArray = [];
        var prev_infobulle;

        function buildInfoWindow(map,cord_hotel,marker,hotelcode,gamme,hotelname,city_name,country_name,etoiles,adresse,cp,url_occup,image_facade_hotel,price,DateRangeStart,DateRangeEnd,note,avis){
            infowindowBubble=null;
            google.maps.event.addListener(marker, 'click', function(){
                contenuInfoBulle = getContentInfoBulle(hotelcode,gamme,hotelname,city_name,country_name,etoiles,adresse,cp,url_occup,image_facade_hotel,price,DateRangeStart,DateRangeEnd,note,avis);
                if(infowindowBubble!=null) infowindowBubble.close();
                infowindowBubble = new google.maps.InfoWindow({
                    map: map,
                    content: contenuInfoBulle, // Contenu de l'infobulle
                    position: cord_hotel, // Coordonnées latitude longitude du marker
                    shadowStyle: 2, // Style de l'ombre de l'infobulle (0, 1 ou 2)
                    padding: 10, // Marge interne de l'infobulle (en px)
                    backgroundColor: 'rgb(255,255,255)', // Couleur de fond de l'infobulle
                    borderRadius: 0, // Angle d'arrondis de la bordure
                    arrowSize: 5, // Taille du pointeur sous l'infobulle
                    borderWidth: 1, // Épaisseur de la bordure (en px)
                    borderColor: '#009EE0', // Couleur de la bordure
                    hideCloseButton: false, // Cacher le bouton 'Fermer'
                    arrowPosition: 50, // Position du pointeur de l'infobulle (en %)
                    arrowStyle: 1, // Type de pointeur (0, 1 ou 2)
                    minWidth : 240, // Largeur minimum de l'infobulle (en px)
                    maxWidth : 260,
                    minHeight : 0,
                    shadow:'0 0 2px #8C8A86',
                    //boxStyle: {box-shadow: "280px"},
                    disableAutoPan: false,
                    alignBottom: true,
                    enableEventPropagation: false
                });
                if(prev_infobulle!=null){
                    prev_infobulle.close();
                }
                var box = document.createElement('div');
                box.style.boxShadow = '0 0 2px #8C8A86';
                prev_infobulle = infowindowBubble;
                infowindowBubble.open(map,marker);
            });
        }

        function getContentInfoBulle(hotelcode,gamme,hotelname,city_name,country_name,etoiles,adresse,cp,url_occup,image_facade_hotel,price,DateRangeStart,DateRangeEnd,note,avis){
            var classPrice = "";
            if(price=="0") classPrice="noPrice";
            contenuInfoBulle = '<div class="infoBulleCarte"><h2>'+gamme+'<br/>'+hotelname.replace(gamme,"")+', '+city_name+' '+etoiles+'</h2><div class="textInfoCarte">'+adresse+', '+cp+', '+city_name+', '+country_name;
            if(price!="0"){
                contenuInfoBulle = contenuInfoBulle+'<div class="prixHotel">à partir de<br /><b>'+price+'</b></div>';
            }
            contenuInfoBulle = contenuInfoBulle+'<div class="visuelInfoCarte">'+image_facade_hotel+'</div><div class="clr"></div>';
            contenuInfoBulle = contenuInfoBulle+'<div class="btnMsg"><a href="{{route("ambassadors")}}/'+ hotelname +'">Demander l\'avis d\'un membre pour cet hôtel</a></div></br><div class="btnHotel"><a href="javascript:void(0)" class="btnForm '+classPrice+'" onclick="tc_events_2(this, \'full_carto_ouverture_fiche_detaillee\',{});Affichedetaillehotels(\''+hotelcode+'\',\''+price+'\',\''+etoiles+'\',\''+url_occup+'\',\''+DateRangeStart+'\',\''+DateRangeEnd+'\',\''+note+'\',\''+avis+'\')">Voir la fiche détaillée</a>';
            if(price!="0"){
                contenuInfoBulle = contenuInfoBulle+'<a class="btnForm lienReserver" href="'+url_occup+'">Réserver</a>';
            }
            contenuInfoBulle = contenuInfoBulle+'</div></div></div>';
            return contenuInfoBulle;
        }
        function gotoMapMarker(indice){
            $(document).ready(function(){
                google.maps.event.trigger(markerz[indice], 'click');
                //$( "#dialog" ).dialog().dialog( "close" );
                $( "#dialog" ).fadeOut("fast");
                infowindowBubble.disableAutoPan =false;
                maCarte.setCenter(markerz[indice].getPosition());
            });
        }

        function init(x, y) {
            $(document).ready(function() {
                $("#liste_hotels").html('');
                var centreCarte = new google.maps.LatLng(x, y);
                var contenuInfoBulle;
                var infobulle;
                var cord_hotel;
                var markerz=new Array();
                var marqueur;
                var optionsMarqueur;
                var optionsCarte = {
                    zoom: 10,
                    center: centreCarte,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    panControl: false,
                    streetViewControl: false
                }
                image = {
                    url: 'http://www.bestwestern.fr/public/images/pictos_miles/puce.png'
                };
                var image_facade_hotel = "";
                var styles = [{
                    featureType: "poi.business",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }];
                $("#titre_hotels").html('Nos hôtels<img alt="" class="flecheTitre" src="http://www.bestwestern.fr/public/images/pictos/fleche-bottom.png" />');
                maCarte = new google.maps.Map(document.getElementById("map-canvas"), optionsCarte);
                maCarte.setOptions({
                    styles: styles
                });
                maCarte.setZoom(parseInt('10'));
                @foreach($hostels as $hostel)
                    var e = "<sup>*</sup><sup>*</sup><sup>*</sup><sup>*</sup>";
                    // afficher marquer au center de la ville selectioneé...//////////////
                    var image_ville = {
                        url: 'http://www.bestwestern.fr/public/images/pictos/map_icon.png'
                    };
                    var cord_center_ville = new google.maps.LatLng($('#locationLat').val(), $('#locationLng').val());
                    if ($('#ville_par_pays').val() != "") {
                        var markerz_center_ville = new google.maps.Marker({
                            position: cord_center_ville,
                            map: maCarte,
                            icon: image_ville,
                            animation: null
                        });
                    }
                    //markersArray.push(markerz_center_ville);
                    $(".prix_show").hide();
                    cord_hotel = new google.maps.LatLng({{$hostel->coordx}}, {{$hostel->coordy}});
                    markerz[{{$count}}] = new google.maps.Marker({
                    position: cord_hotel,
                    map: maCarte,
                    icon: image,
                    title: '{{$hostel->category}} {{$hostel->name}}',
                    animation: null
                });
                    markersArray.push(markerz[{{$count}}]);
                    $("#liste_hotels").append('<li id="opener{{$count}}" onmouseleave="outhover(this)" onmouseenter="hoverLi(this);" onclick="gotoMapMarker({{$count}}); clickLi(this);"><div class="visuelListeHotels"><a style="cursor: pointer;" class="nounderline"><img src="http://www.bestwestern.fr/public/images/pictos_miles/hotel_gamme/bw16_mini.png "/></a></div><div class="contentListeHotels"><a href="javascript:void(0)" class="nounderline">{{$hostel->category}} {{$hostel->name}}, Paris &nbsp;' + e + '<span> {{$hostel->address}}, {{$hostel->zipCode}}, {{$hostel->city}}, France</span></a></div><div class="clr"></div></li>');
                    buildInfoWindow(maCarte, cord_hotel, markerz[{{$count}}], '{{$hostel->coord}}', '', '{{$hostel->name}}', '{{$hostel->city}}', 'France', e, '{{$hostel->address}}', '{{$hostel->zipCode}}', 'http://www.bestwestern.fr/infos_hotel.jsp?HotelCode={{$hostel->coord}}&amp;primarylangid=fr-FR&amp;RequestedCurrencyCode=EUR&amp;ChainCode=BW&amp;roomStay=1', image_facade_hotel, '0', '', '', '4', '526');
                    {{$count ++}}
                 @endforeach
                 getHotelsOnDraggendMap();
            });
        }

        function hoverLi(li) {
            $(document).ready(function() {
                $(li).addClass("hover");
            });
        }

        function clickLi(li) {
            $(document).ready(function() {
                $("#liste_hotels li").removeClass("click");
                $("#liste_hotels li").removeClass("hover");
                $(li).addClass("click");
            });
        }

        function outhover(li) {
            $(document).ready(function() {
                if (!$(li).hasClass("click")) {
                    $(li).removeClass("hover");
                    $(li).removeClass("click");
                }
            });
        }
        // Supprimer tout markers dans array
        function deleteOverlays() {
            if (markersArray) {
                //for (i in markersArray) {
                for (var i = 0; i < markersArray.length; i++) {
                    //markersArray[i].setMap(null);
                    //alert("okk");
                    markersArray[i].setVisible(false);
                    //markersArray = null;
                }
                markersArray.length = 0;
            }
        }

        function getHotelsOnDraggendMap() {
            $(document).ready(function() {
                google.maps.event.addListener(maCarte, 'dragend', function() {
                    document.getElementById('ville_par_pays').value = "";
                    document.getElementById('ville_par_pays').placeholder = 'ex : Ville / Adresse / Lieu ...';
                    document.getElementById('cityname').value = "";
                    var categ1 = '';
                    var categ2 = '';
                    var categ3 = '';
                    var categ4 = '';
                    var categ5 = '';
                    var DateRangeStart = $("#DateRangeStart").val();
                    var DateRangeEnd = $("#DateRangeEnd").val();
                    var marqueur;
                    var infosCenterMap = maCarte.getCenter();
                    var latitude = infosCenterMap.lat();
                    var longitude = infosCenterMap.lng();
                    $('#locationLat').val(latitude);
                    $('#locationLng').val(longitude);
                    var roomQuantity = $("#roomQuantity option:selected").val();
                    image = {
                        url: 'http://www.bestwestern.fr/public/images/pictos_miles/puce.png'
                    };
                    var them = '';
                    var idequip, equip;
                    idequip = "";
                    idequip = idequip.replace(idequip.charAt(0), "");
                    equip = "";
                    var num_persons_per_room = new Array();
                    var max = 1;
                    var adult = new Array();
                    var child = new Array();
                });
            });
        }
    </script>
<div id="content" class="accueil">
    <div id="map-canvas" style="width: 100%; position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">Map loading...</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        init(48.856614, 2.3522219000000177);
    });
</script>
@stop