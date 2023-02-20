<template>
    <fieldset class="flex items-center mt-1">
        <label v-for="ratingValue in rating.values">
            <svg :class="isActive(ratingValue) ? 'text-primary' : 'text-gray-400'" class="w-8 h-8 fill-current cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"></path></svg>

            <input
                class="sr-only"
                type="radio"
                v-model="value"
                :name="'stars' + rating.id"
                :value="{ id: rating.id, value_id: ratingValue.value_id }"
                required
            />
        </label>
    </fieldset>
</template>

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
