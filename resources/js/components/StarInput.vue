<template>
    <fieldset class="flex items-center mt-1">
        <label v-for="index in 5" :for="'star-' + index">
            <svg :class="(inputValue && index <= ratingIndex) ? 'text-primary' : 'text-gray-400'" :id="'star-icon-' + index" class="w-8 h-8 fill-current cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"></path></svg>
            <input v-model="inputValue" class="hidden" type="radio" :id="'star-' + index" :name="name" :value="index" required />
        </label>
    </fieldset>
</template>
<script>
    export default {
        props: [
            'value',
            'name',
            'ratingId',
            'ratingValues'
        ],
        data() {
            return {
                changes: {
                    ratings: ''
                },
                ratingValue: {
                    value_id: '',
                    id: ''
                }
            }
        },
        methods: {
            getRatingValue(value) {
                return this.ratingValues[value - 1]
            }
        },
        computed: {
            inputValue: {
                get() {
                    return this.value
                },
                set(value) {
                    this.ratingValue.id = this.ratingId
                    this.ratingValue.value_id = this.getRatingValue(value)['value_id']

                    this.$emit('input', this.ratingValue)
                }
            },
            ratingIndex() {
                if (this.inputValue) {
                    return this.ratingValues.find(rating => {
                        return rating.value_id == this.inputValue.value_id
                    }).value;
                }
            }
        }
    }
</script>
