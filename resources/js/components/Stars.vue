<template>
    <div v-if="stars" class="flex items-start">
        <div class="flex items-center">
            <svg v-for="star in stars" :class="class_star" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
            <svg v-for="star in 5 - stars" :class="class_star_inactive" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
            <span :class="class_count" v-if="this.count">({{ this.count }})</span>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            score: {
                type: Number,
                required: true
            },
            count: {
                type: Number,
                required: false
            },
            class_star: {
                type: String,
                required: false,
                default: 'w-4 h-4 fill-current text-primary'
            },
            class_star_inactive: {
                type: String,
                required: false,
                default: 'w-4 h-4 fill-current text-gray-400'
            },
            class_count: {
                type: String,
                required: false,
                default: 'text-gray-500 text-sm'
            }
        },
        computed: {
            stars() {
                return Math.round(this.score / 100 * 5)
            }
        }
    }
</script>
