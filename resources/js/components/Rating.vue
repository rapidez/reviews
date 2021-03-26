<template>
    <div v-if="stars > 0" class="flex items-start">
        <div class="flex items-center">
            <svg v-for="star in stars" :class="'w-4 h-4 fill-current ' + star_class" :viewBox="viewBox"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
            <svg v-for="star in 5 - stars" :class="'w-4 h-4 fill-current ' + star_class_inactive" :viewBox="viewBox"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
            &nbsp;({{ this.reviews_count }})
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            reviews_count: {
                required: true
            },
            rating_summary: {
                required: true
            },
            star_size: {
                type: Number,
                required: false,
                default: 20
            },
            star_class: {
                type: String,
                required: false,
                default: 'text-primary'
            },
            star_class_inactive: {
                type: String,
                required: false,
                default: 'text-gray-400'
            }
        },
        computed: {
            stars() {
                return Math.round(this.rating_summary / 100 * 5)
            },
            viewBox() {
                return '0 0 ' + this.star_size + ' ' + this.star_size
            }
        }
    }
</script>
