                <!-- Google Map -->
                <div wire:ignore class="mt-4 ">
                    <label class="block font-medium">Pin Your Location:</label>
                    <!-- Address Input -->
         
                <input type="hidden" id="latitude" wire:model.defer="latitude">
                <input type="hidden" id="longitude" wire:model.defer="longitude">

                <!-- Google Maps Input Field -->
                <input id="pac-input" class="form-control w-full border p-3 rounded mb-4" type="text" placeholder="Enter your location">


                <!-- Map Container -->
                <div id="map" class="w-full h-[400px] border rounded relative"></div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end space-x-2">
                    <button @click="showModal = false" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button wire:click="submitOrder" class="bg-green-500 text-white px-4 py-2 rounded">Confirm Order</button>
                </div>
                </div>
                </div>
                </div>

                <!-- Load the Google Maps JavaScript API with the Places library -->


                <script async defer
                src="https://maps.gomaps.pro/maps/api/js?key=AlzaSyY_zJLBXnoi4nHjjBmek7l1hjflOrdKYfg&libraries=geometry,places&callback=initMap">
                </script>
                <!-- <script async defer
                src="./gogleplaces2.js">
                </script> -->

            <script>
            let map, marker, autocomplete;

            function initMap() {
                const defaultLocation = { lat: 14.5995, lng: 120.9842 }; // Manila, PH

                map = new google.maps.Map(document.getElementById('map'), {
                    center: defaultLocation,
                    zoom: 14,
                    mapTypeControl: false,
                    streetViewControl: false
                });

                marker = new google.maps.Marker({
                    position: defaultLocation,
                    map: map,
                    draggable: true
                });

                const input = document.getElementById('pac-input');
                autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                // 📌 Fix: Ensure map does not disappear on marker drag
                google.maps.event.addListener(marker, 'dragstart', () => {
                    map.setOptions({ gestureHandling: "none" }); // Temporarily disable gestures
                });

                // 📌 Fix: Properly update marker position when dragging ends
                google.maps.event.addListener(marker, 'dragend', (event) => {
                    let newPosition = event.latLng;
                    
                    document.getElementById('latitude').value = newPosition.lat();
                    document.getElementById('longitude').value = newPosition.lng();

                    map.setOptions({ gestureHandling: "auto" }); // Re-enable gestures
                    map.setCenter(newPosition); // Keep the map centered

                    // ✅ Livewire dispatch with correct parameter format
                    //Livewire.dispatch('updateLocation', newPosition.lat(), newPosition.lng());
                    Livewire.dispatch('updateLocation', { lat: newPosition.lat(), lng: newPosition.lng() });
                });

                // 📌 Fix: Ensure autocomplete correctly updates marker
                autocomplete.addListener('place_changed', () => {
                    let place = autocomplete.getPlace();
                    if (!place.geometry) return;

                    map.setCenter(place.geometry.location);
                    marker.setPosition(place.geometry.location);

                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();

                    // ✅ Livewire event update
                    LLivewire.dispatch('updateLocation', { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() });

                });

                // 📌 Add "My Location" Button
                const locationButton = document.createElement("button");
                locationButton.textContent = "📍 My Location";
                locationButton.classList.add("custom-map-control-button");
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

                locationButton.addEventListener("click", () => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            let userLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };

                            marker.setPosition(userLocation);
                            map.setCenter(userLocation);
                            map.setZoom(17);

                            document.getElementById('latitude').value = userLocation.lat;
                            document.getElementById('longitude').value = userLocation.lng;

                            // ✅ Livewire event update
                        Livewire.dispatch('updateLocation', { lat: userLocation.lat, lng: userLocation.lng });

                        }, (error) => {
                            alert("Error getting location: " + error.message);
                        });
                    } else {
                        alert("Geolocation is not supported by this browser.");
                    }
                });
            }

                            </script>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

              <script>
               document.addEventListener('DOMContentLoaded', function () {
                Livewire.on('swal', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User created successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            });
              </script>
              
                
