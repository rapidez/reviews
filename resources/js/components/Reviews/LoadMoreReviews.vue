<script>
export default {
    data: () => ({
        reviews: null,
        reviewPage: 1,
    }),
    render() {
        return this.$scopedSlots.default(this);
    },
    methods: {
        addReviews(data, response) {
            if (this.reviews === null) {
                this.reviews = [];
            }

            if (!response?.data?.products?.items.length) {
                return
            }
            if (response.data.products.items[0].reviews.items.length > 0) {
                this.reviews.push(
                    ...response.data.products.items[0].reviews.items
                );
            }

        },
        nextPage() {
            this.reviewPage++;
        },
    },
};
</script>
