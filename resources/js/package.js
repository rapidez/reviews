import { defineAsyncComponent } from 'vue'

document.addEventListener('vue:loaded', function (event) {
    const vue = event.detail.vue
    vue.component('LoadMoreReviews', defineAsyncComponent(() => import('./components/Reviews/LoadMoreReviews.vue')))
})
