	if ($('#map-contact').length) {
		var map = L.map('map-contact', {
			zoom: 15,
			maxZoom: 60,
			tap: false,
			gestureHandling: true,
			center: [47.129511821917504, 24.49245329224116]
		});

		map.scrollWheelZoom.disable();

		var Hydda_Full = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
			scrollWheelZoom: false,
			attribution: ''
		}).addTo(map);

		var icon = L.divIcon({
			html: '<i class="fa fa-building"></i>',
			iconSize: [50, 50],
			iconAnchor: [50, 50],
			popupAnchor: [-20, -42]
		});

		var marker = L.marker([47.129511821917504, 24.49245329224116], {
			icon: icon
		}).addTo(map);
	}
