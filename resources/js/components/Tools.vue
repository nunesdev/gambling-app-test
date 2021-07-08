<template>
  <div class="tools">
    <div class="card" >
      <div class="card-body">
       <div class="row text-center">
          <div class="col" :class="{ active : currentDistance == 100}" @click="setDistance(100)">100km</div>
          <div class="col" :class="{ active : currentDistance == 50}" @click="setDistance(50)">50km</div>
          <div class="col" :class="{ active : currentDistance == 10}" @click="setDistance(10)">10km</div>
        </div>
      </div>
    </div>
    <div class="card" >
      <div class="card-body">
       <div class="row text-center">
          <div class="col" :class="{ active : isMap}" @click="setLayer(true)">Map</div>
          <div class="col" :class="{ active : !isMap}" @click="setLayer(false)">List</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
export default {
  data() {
    return {
      currentDistance: 100,
      isMap: false
    }
  },
  methods: {
    setDistance(value) {
      this.currentDistance = value
      this.$emit('distance', value)
    },
    setLayer(value) {
      this.isMap = value
      this.$emit('layer', value)
    }
  }
}
</script>
