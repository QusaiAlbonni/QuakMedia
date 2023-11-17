<template>
    <button class="mr-2 text-primary" @click="likeReply" v-text="buttonText"></button>
</template>

<script>
import axios from 'axios';

export default {
    props: ['reply-id', "likes", 'likecount'],

    data: function () {
        return {
            status: this.likes,
            likeCount : this.likecount,
        }
    },

    methods: {
        likeReply() {
            axios.post('/like/reply/' + this.replyId)
                .then(response => {
                    this.status = !this.status;

                    console.log(response.data);

                    if (response.data.attached.length)
                        this.likeCount++;
                    else
                        this.likeCount--;
                }).catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }

                });
        }
    },
    computed: {
        buttonText() {

            return this.status ? 'liked' + ' ' + this.likeCount: 'like' + ' ' + this.likeCount;
        }
    }
}
</script>
