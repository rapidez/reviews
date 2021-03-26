try {
    Vue.component('product-rating', require('./components/Rating.vue').default)
    Vue.component('star-input', require('./components/StarInput.vue').default)
} catch (e) {}
