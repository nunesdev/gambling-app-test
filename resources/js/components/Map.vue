<template>
  <div class="map" :class="{'lock':mapIsLock}">
    <MglMap
        :accessToken="accessToken"
        :mapStyle.sync="mapStyle"
        :center="center"
        :zoom="zoom"
        @load="onMapLoad"
        :attributionControl="false"
      >
      <MglNavigationControl position="bottom-right" />

      <MglMarker :draggable="true"  :coordinates="center" color="#d41c1c"></MglMarker>
      <MglMarker v-for="(item,index) in items" :key="index" :coordinates="[item.longitude,item.latitude]" color="#3bb381">
        <MglPopup :showed="index==0" :coordinates="[item.longitude,item.latitude]" anchor="bottom">
          <div class="popup">{{item.name}}</div>
        </MglPopup>
      </MglMarker>
    </MglMap>
  </div>
</template>
<script>
import Mapbox from "mapbox-gl";
import {
  MglMap, MglPopup, MglMarker, MglAttributionControl,
  MglNavigationControl } from "vue-mapbox" 

import MglGeocoderControl from 'vue-mapbox-geocoder' 

export default {
  props: {
    mapIsLock: Boolean,
    items: Array
  },
  name: 'Map',
  components: {
    MglMap,
    MglMarker,
    MglPopup,
    MglAttributionControl,
    MglNavigationControl,
    MglGeocoderControl,
  },
  created() {
    this.mapbox = Mapbox;
    this.mapboxgeocoder = MglGeocoderControl
  },
  mounted() {
  },
  data() {
    return {
      isLock: false,
      mapbox: undefined,
      mapboxgeocoder: undefined,
      accessToken: 'pk.eyJ1IjoiYnJ1bm9kZXZzcCIsImEiOiJjazd6NzBocmwwMnQ5M2xvcWg0YmxqNmZpIn0.rfIgqe3-QTrf16tIVgjgjg',
      mapStyle: 'mapbox://styles/mapbox/streets-v11',
      center: [-6.253530,53.334830],
      zoom: 9,
    }
  },
  methods: {
    onMapLoad(event) {
      this.map = event.map
    },
  }
}
</script>
