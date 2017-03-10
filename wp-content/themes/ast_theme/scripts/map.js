$(document).ready(function(){
	var address = document.getElementById('address').value;
	ymaps.ready(function () {
		
		console.log(address);
		var myMap = new ymaps.Map('map', {
				center: [55.751574, 37.573856],
				zoom: 9
			}, {
				searchControlProvider: 'yandex#search'
			});
		ymaps.geocode(address, {
        results: 1
    }).then(function (res) {
            // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');

            myMap.geoObjects.add(firstGeoObject);
            myMap.setBounds(bounds, {
                
                checkZoomRange: true
            });

        });
	});

});