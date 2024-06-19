<template>
	<div class="content max-w-2xl: grid grid-cols-5 gap-x-3 gap-y-4 mb-6">
		<Product v-for="product in products" :product="product" :key="product.id"></Product>
	</div>
	<div ref="loading" class="w-full transition-all duration-700" :class="{
		'opacity-0' : !loading,
		'opacity-1' : loading
	}">
		<div @click.prevent="retryLoadPosts" class="w-full py-4 px-6 text-center bg-gray-300">
			{{ loadingTitle }}
		</div>
	</div>
</template>

<script lang="ts">
import Product from '@/Components/Product.vue';
import { debounce } from "lodash";
import axios from "axios";

export default {
	name: "Index",
	data() {
		return {
			products: [],
			page: 1,
			loading: false,
			showRetry: true,
			sendingRequest: false,
			debouncedEventHandler: debounce(() => this.handleScroll(), 400)
		};
	},
	mounted() {
		this.loadProducts();
		window.addEventListener('scroll', this.debouncedEventHandler);
	},
	beforeDestroy() {
		window.removeEventListener('scroll', this.debouncedEventHandler);
	},
	methods: {
		async loadProducts() {
			if (this.sendingRequest) return;
			this.sendingRequest = true;
			this.loading = true;
			try {
				const response = await axios.post(route('api.post.index'), { page: this.page });
				if (response.data?.data?.length) {
					this.sendingRequest = false;
					this.loading = false;
					this.page++;
					this.products.push(...response.data.data);
					this.handleScroll();
				} else {
					this.sendingRequest = false;
					this.loading = false;
					window.removeEventListener('scroll', this.debouncedEventHandler);
				}
			} catch (error) {
				this.sendingRequest = false;
				this.loading = false;
				this.showRetry = false;
				window.removeEventListener('scroll', this.debouncedEventHandler);
			}
		},
		retryLoadPosts() {
			if (this.showRetry) return;
			if (this.sendingRequest) return;
			this.loadProducts();
		},
		handleScroll() {
			const loadingElement = this.$refs.loading;
			if (loadingElement) {
				const rect = loadingElement.getBoundingClientRect();
				const viewportHeight = window.innerHeight;
				const threshold = viewportHeight * 0.5;
				const isNearBottom = rect.top < viewportHeight + threshold;

				if (isNearBottom) {
					this.loadProducts();
				}
			}
		}
	},
	computed: {
		loadingTitle() {
			return this.showRetry ? 'Идет загрузка...' : 'Повторить загрузку еще?...'
		}
	},
	components: {
		Product
	}
}
</script>
