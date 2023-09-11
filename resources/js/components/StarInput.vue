<script>
    export default {
        props: {
            rating: {
                type: Object,
                required: true,
            },
            value: {
                type: Object,
                required: false
            },
        },
        render() {
            return this.$scopedSlots.default(this)
        },

        watch: {
            value() {
                this.$emit('input', this.value);
            }
        },

        methods: {
            isActive(ratingValue) {
                return this.value && ratingValue.value <= this.rating.values.find(
                    (ratingValue) => ratingValue.value_id == this.value.value_id
                ).value
            }
        }
    }
</script>
