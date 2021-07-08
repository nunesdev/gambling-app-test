<template>
	<div class="wrapper">
		
		<Header/>
		<Tools  @distance="setNewDistance" @layer="setNewLayer"/>

		<div v-if="mapIsLock" class="container affiliates-list">
			<div class="row justify-content-center">
				<div class="col-md-8 pt-4">
					<h1 class="affiliates-list__title">Affiliates list</h1>
					<!-- <input @input="filterAffiliates" type="text" class="form-control" placeholder="Filter by name"> -->
					<div class="overflow-auto">
						<table class="table table-info table-striped">
								<tr v-for="item in sortArray" :key="item.affiliate_id">
									<td>{{item.affiliate_id}}</td>
									<td>{{item.name}}</td>
								</tr>
							</table>
					</div>
				</div>
			</div>
		</div>
		<Map :mapIsLock="mapIsLock" :items="sortArray" />
	</div>
</template>

<script>
  import axios from 'axios'
	import Map from './Map.vue'
	import Header from './Header'
	import Tools from './Tools'

	export default {
		components: { Header, Map, Tools },
		data() {
			return {
				mapIsLock: true,
				distance: 100,
				center: {
					lat : 53.3340285, 
					long : -6.2535495
				},
				affiliates: [],
				affiliates_filtered: []
			}
		},
		mounted() {
			this.getAffiliates()
		},
		computed: {
			sortArray() {
				function compare(a,b){
					if(a.affiliate_id < b.affiliate_id) return -1
					if(a.affiliate_id > b.affiliate_id) return 1
					return 0
				}
				return this.affiliates_filtered.sort(compare)
			},
		},
		methods: {
			async getAffiliates() {
				const promise = await axios.get('/api/affiliates')
				this.affiliates = promise.data
				console.log(this.affiliates);
				this.affiliates_filtered =  this.affiliates.filter(this.checkDistance)
				console.log(this.affiliates);
			},
			checkDistance(item) {
				const distance = this.getDistance(item.latitude, item.longitude, this.center.lat, this.center.long)
				console.log(this.distance);
				if(distance < this.distance) return item
			},
			getDistance(lat1, lon1, lat2, lon2) {
				const EarthRadius = 6371; 
				const dLat = this.deg2rad(lat2 - lat1);
				const dLon = this.deg2rad(lon2 - lon1);
				const a =
					Math.sin(dLat / 2) * Math.sin(dLat / 2) +
					Math.cos(this.deg2rad(lat1)) *
						Math.cos(this.deg2rad(lat2)) *
						Math.sin(dLon / 2) *
						Math.sin(dLon / 2);
				const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
				const d = EarthRadius * c;

				return d;
			},
			deg2rad(deg) {
				return deg * (Math.PI / 180);
			},
			setNewDistance(value) {
				this.distance = value
				this.affiliates_filtered = this.affiliates.filter(this.checkDistance)
			},
			setNewLayer(value) {
				this.mapIsLock = !value
			}
		}
	}
</script>
