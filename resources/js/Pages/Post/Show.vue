<template>
	<div class="content p-3">
		<div v-if="product" class="text-red-600 bg-amber-600 text-4xl">{{ product.id }}</div>
		<div v-if="product" class="text-black text-3xl line-through decoration-12 decoration-red-500 decoration-dashed">{{ product.title }}</div>
		<div v-if="product" class="text-black text-2xl">{{ product.content }}</div>
		<div v-if="product" class="text-black text-2xl">{{ product.images }}</div>
	</div>
	<div ref="loading" class="w-full transition-all duration-700" :class="{
		'opacity-0' : !loading,
		'opacity-1' : loading || !isSending
	}">
		<div @click.prevent="retryLoadPosts" class="w-full py-4 px-6 text-center bg-gray-300">
			{{ loadingTitle }}
		</div>
	</div>
</template>

<script lang="ts">
import axios from "axios";

export default {
	name: "Show",
	props: [
		'id'
	],
	data() {
		return {
			product: null,
			loading: false,
			isSending: true,
		};
	},
	mounted() {
		this.loadProduct();
	},
	methods: {
		async loadProduct() {
			if (this.loading) return;
			this.loading = true;
			try {
				const response = await axios.get(route('api.post.show', this.id));
				if (response.data) {
					this.isSending = true;
					this.product = response.data;
				} else {
					this.isSending = false;
				}
			} catch (error) {
				this.isSending = false;
			} finally {
				this.loading = false;
			}
		},
		retryLoadPosts() {
			if (this.loading) return;
			this.loadProduct();
		},
	},
	computed: {
		loadingTitle() {
			return this.isSending ? 'Идет загрузка...' : 'Повторить загрузку еще?...'
		}
	},
}
</script>
