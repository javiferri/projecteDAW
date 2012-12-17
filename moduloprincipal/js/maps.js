function initialize() {
  if (GBrowserIsCompatible()) {
	var map = new GMap2(document.getElementById("map_canvas"));
	map.setCenter(new GLatLng(38.821538,-0.596051), 14);
		map.addControl(new GMapTypeControl());
		map.addControl(new GLargeMapControl());
		map.addControl(new GScaleControl());

	function info(u,d){
		var m = new GMarker(u);
		GEvent.addListener(m,"click",function() {
			m.openInfoWindowHtml(d);
		});
	return m;
	}
	var d = '<b><i>Aqui está Gimnasio Ferri</i></b>';
	
	var u = new GLatLng(38.821538,-0.596051);
	var mar = info(u,d);
	map.addOverlay(mar);
  }
}