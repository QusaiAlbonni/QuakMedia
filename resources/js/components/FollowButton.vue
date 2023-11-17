<template>
    <div>
        <button class="btn text-primary ml-0 p-0 mx-2 mb-0" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        props:['user-id', "follows"],

        data: function () {
            return {
                status: this.follows,
            }
        },

        methods:{
            followUser(){
                axios.post('/follow/' + this.userId)
                .then(response => {
                    this.status = !this.status;


                    console.log(response.data);
                }).catch( errors =>{
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }

                });
            }
        },
        computed: {
            buttonText(){
                return this.status ? 'Followed' : 'Follow';
            }
        }
    }
</script>
