<template>
    <div>
        <extrasproform-component @new="addItem"></extrasproform-component>

    <table class="table">
        <tbody>
            <tr>
                <extrasproitem-component 
                    v-for="(item, index) in prolist" 
                    :key="item.id"
                    :item="item"
                    @delete="deleteItem(index)">
                </extrasproitem-component>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                prolist:[{
                    'id': 1,
                    'extra_id': 1,
                    'quantity': 4 
                }]
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            addItem(item) {
                this.prolist .push(item);
            },
            deleteItem(index) {
                this.prolist.splice(index, 1);
            }
        }
    }
</script>  