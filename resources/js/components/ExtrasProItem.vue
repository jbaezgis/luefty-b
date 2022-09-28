<template>
    <div>
        <td scope="row">
            {{ item.quantity }} {{ item.extra_id }}
        </td>
        <td>
            <button class="btn btn-danger" v-on:click="onClickDelete()"><i class="fa fa-trash"></i>
            </button>
        </td>
    </div>
</template>

<script>
    export default {
        props: ['item'],
        data() {
            return {
                
            };
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            onClickDelete() {
                this.$emit('delete');
            }
        }
    }
</script>  