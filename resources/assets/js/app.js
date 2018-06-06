/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
	data() {
		return {
			doingRequest: false,
			king: null
		}
	},
	computed: {
		showFindKingButton() {
			return this.king === null;
		}
	},
	methods: {
		hideKing() {
			this.king = null;
		},
		findKing() {
			if (this.doingRequest) {
				return;
			}
			this.doingRequest = true;
			this.king = null;

			axios.get('/api/pokemons/king').then((res) => {
				this.doingRequest = false;
				this.king = res.data;
			});
		}
	}
});
