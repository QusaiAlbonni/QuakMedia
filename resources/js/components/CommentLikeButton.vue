<template>
    <button class="mr-2 text-primary" @click="likeComment" v-text="buttonText"></button>
</template>

<script>
import axios from 'axios';

export default {
    props: ['comment-id', "likes", 'likecount'],

    data: function () {
        return {
            status: this.likes,
            likeCount : this.likecount,
        }
    },

    methods: {
        likeComment() {
            axios.post('/like/comment/' + this.commentId)
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
