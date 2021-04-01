<script src="https://maps.googleapis.com/maps/api/js?key={{config("app.Google_Map_Key") }}&callback=initMap" async defer></script>
<script>
    let map;

function initMap() {
map = new google.maps.Map(document.getElementById("map"), {
center: { lat:  {{config("app.Google_Map_Latitude") }} ,lng: {{config("app.Google_Map_Longitude") }} },
zoom: 8,
});
}
</script>
