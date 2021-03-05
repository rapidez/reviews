<script>
    export default {
        props: ['product'],
        render() {
            return this.$scopedSlots.default({
                rating: {
                    stars: this.stars,
                },
                reviews: this.reviews,
                locale: window.navigator.language
            })
        },
        computed: {
            stars() {
                return Math.round(this.product.rating_summary / 100 * 5)
            },
            reviews() {
                return this.product.reviews.items
            }
        }
    }
</script>
