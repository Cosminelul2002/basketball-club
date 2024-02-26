<template>
	<div>
		<Header />

		<main>
			<slot></slot>
		</main>

		<Footer />
	</div>
</template>

<script>

import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
	name: 'AppLayout',

	components: {
		Header,
		Footer
	},
}
</script>