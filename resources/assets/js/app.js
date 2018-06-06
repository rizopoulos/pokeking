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
			/**
			 * If a AJAX reqeust is running this will be true.
			 * We need to make sure the multiple ajax requests
			 * are fired vie click event of FIND THE KING button
			 */
			doingRequest: false,
			/**
			 * Stores the king data
			 */
			king: null
		}
	},
	computed: {
		/**
		 * We need to show the FIND THE KING button only if Pokemon King is not found
		 * @returns {boolean}
		 */
		showFindKingButton() {
			return this.king === null;
		}
	},
	methods: {
		/**
		 * Click event handler to hide the SHOW THE KING button
		 */
		hideKing() {
			this.king = null;
		},
		/**
		 * click event handler to find the pokemon king
		 */
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
