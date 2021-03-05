try {
    Vue.component('product-reviews', require('./components/Review.vue').default)
    Vue.component('star-input', require('./components/StarInput.vue').default)
} catch (e) {}
