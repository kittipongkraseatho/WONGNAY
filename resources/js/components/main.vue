<template>
    <div>
        <main>
            <section class="py-5 text-center container">
                <div class="row py-2">
                    <div class="col-lg-10 col-md-8 mx-auto">
                        <gmap-map
                            :center="mapCenter"
                            :zoom="zoom"
                            style="width: 100%; height: 320px"
                        >
                            <gmap-info-window
                                :options="infoWindowOptions"
                                :position="infoWindowPosition"
                                :opened="infoWindowOpened"
                                @closeclick="handleInfoWindowClose"
                            >
                                <div class="info-window">
                                    <img
                                        class="img-fluid img-thumbnail"
                                        width="100"
                                        height="100"
                                        :src="activeRestaurant.img"
                                    />
                                    <h4 style="margin-top: 25px">
                                        {{ activeRestaurant.name }}
                                        <button
                                            type="button"
                                            v-if="activeRestaurant.open_shop"
                                            class="btn btn-sm btn-success"
                                        >
                                            เปิดร้าน
                                        </button>
                                        <button
                                            type="button"
                                            v-else
                                            class="btn btn-sm btn-danger"
                                        >
                                            ยังไม่เปิดร้าน
                                        </button>
                                    </h4>
                                    <div
                                        class="d-flex justify-content-between align-items-center"
                                    >
                                        <p>
                                            เวลาให้บริการ :
                                            {{ activeRestaurant.open }} -
                                            {{ activeRestaurant.close }}
                                        </p>
                                    </div>
                                </div>
                            </gmap-info-window>
                            <gmap-marker
                                v-for="listRestaurants in restaurants"
                                :key="listRestaurants.id"
                                :position="getPosition(listRestaurants)"
                                :clickable="true"
                                :draggable="false"
                                @click="handleMarkerClick(listRestaurants)"
                            ></gmap-marker>
                        </gmap-map>
                    </div>
                </div>
            </section>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row justify-content-md-center mb-1">
                        <div class="col-md-auto">
                            <h5>ค้นหา</h5>
                        </div>
                    </div>
                    <div class="row justify-content-md-center mb-5">
                        <div class="col-md-auto">
                            <vue-bootstrap-typeahead
                                v-model="search"
                                :data="lists"
                            />
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div
                            class="col"
                            v-for="listRestaurants in restaurants"
                            :key="listRestaurants.id"
                        >
                            <div class="card shadow-sm">
                                <img :src="listRestaurants.img" />

                                <div class="card-body">
                                    <h4>
                                        {{ listRestaurants.name }}
                                        <button
                                            type="button"
                                            v-if="listRestaurants.open_shop"
                                            class="btn btn-sm btn-success"
                                        >
                                            เปิดร้าน
                                        </button>
                                        <button
                                            type="button"
                                            v-else
                                            class="btn btn-sm btn-danger"
                                        >
                                            ยังไม่เปิดร้าน
                                        </button>
                                    </h4>
                                    <div
                                        class="d-flex justify-content-between align-items-center"
                                    >
                                        <p>
                                            ที่อยู่ :
                                            {{ listRestaurants.address }},
                                            {{ listRestaurants.district }},
                                            {{ listRestaurants.province }}
                                        </p>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-center"
                                    >
                                        <p>
                                            เวลาให้บริการ :
                                            {{ listRestaurants.open }} -
                                            {{ listRestaurants.close }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            lists: [],
            zoom: 15,
            restaurants: [],
            search: "Bang sue",
            listSearch: null,
            infoWindowOptions: {
                pixelOffset: {
                    width: 0,
                    height: 0,
                },
            },
            activeRestaurant: {},
            infoWindowOpened: false,
        };
    },
    created() {
        this.searchRestaurant(this.search);
    },
    mounted() {
        this.getListRestaurant();
    },
    methods: {
        handleInfoWindowClose() {
            this.activeRestaurant = {};
            this.infoWindowOpened = false;
        },
        handleMarkerClick(restaurants) {
            this.activeRestaurant = restaurants;
            this.infoWindowOpened = true;
        },
        getPosition(position) {
            return {
                lat: parseFloat(position.latitude),
                lng: parseFloat(position.longitude),
            };
        },
        async searchRestaurant(search) {
            if (search) {
                this.restaurants = await axios
                    .get(`/api/restaurants/list_state/${search}`)
                    .then((res) => {
                        return res.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        async getListRestaurant() {
            this.lists = await axios
                .get(`/api/restaurants/list_state`)
                .then((res) => {
                    return res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    watch: {
        search(val) {
            if (val != null || val != "" || val) {
                this.searchRestaurant(val);
            }
        },
    },
    computed: {
        mapCenter() {
            if (!this.restaurants.length || !this.restaurants[0].name) {
                return {
                    lat: 13.828447,
                    lng: 100.527407,
                };
            }
            return {
                lat: parseFloat(this.restaurants[0].latitude),
                lng: parseFloat(this.restaurants[0].longitude),
            };
        },
        infoWindowPosition() {
            return {
                lat: parseFloat(this.activeRestaurant.latitude),
                lng: parseFloat(this.activeRestaurant.longitude),
            };
        },
    },
};
</script>
