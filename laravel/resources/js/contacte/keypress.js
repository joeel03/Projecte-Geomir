function showPosition(position) {
    alert("Latitude: " + position.coords.latitude + 
        "\nLongitude: " + position.coords.longitude)
}
//Dreceres de teclat
var listener = new window.keypress.Listener();
listener.simple_combo("ctrl alt g", function getLocation() {
    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(showPosition);
    } else {

        x.innerHTML = "Geolocation is not supported by this browser.";

    }

});
var listener2 = new window.keypress.Listener();
listener2.simple_combo("ctrl alt c", function () {

    L.map('map').setView([41.23114477320315, 1.7281181849031044], 18);

})
