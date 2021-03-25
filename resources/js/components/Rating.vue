<template>
    <div v-if="stars > 0" class="flex items-start">
        <div class="flex items-center">
            <div class="flex items-center">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <svg v-for="star in stars" class="w-4 h-4 fill-current text-primary" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        <svg v-for="star in 5 - stars" class="w-4 h-4 fill-current text-gray-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    </div>
                    &nbsp;({{ this.product.reviews_count }})
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['product'],
        computed: {
            stars() {
                return Math.round(this.product.rating_summary / 100 * 5)
            }
        }
    }
</script>
