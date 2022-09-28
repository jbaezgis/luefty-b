<template>
    <form action="" v-on:submit.prevent="newItem()">
        
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 w-100 bd-highlight">
                <div class="form-group">
                    <label for="extra_id">Extra</label>
                     <input type="number" class="form-control" name="extra_id" v-model="extra_id" required>
                    
                </div> <!-- end form-group-->
            </div><!-- end flex item-->
            <div class="p-2 bd-highlight">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" v-model="quantity" required>
                    
                </div> <!-- end form-group-->
            </div><!-- end flex item-->
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 32px">
                    Add
                </button>
            </div><!-- end flex item-->
        </div><!-- end flex row-->
        
    </form>
</template>

<script>
    export default {
        data() {
            return {
                extra_id: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newItem() {
                const params = {
                    extra_id: this.extra_id,
                    quantity: this.quantity
                };
                axios.post('/extraspro', params).then((response) => console.log(response));
                let item = {
                    id: 2,
                    extra_id: this.extra_id,
                    quantity: this.quantity
                };
                this.$emit('new', item);
                this.extra_id = '';
                this.quantity = '';
            }
        }
    }
</script>  