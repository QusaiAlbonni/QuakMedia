<template>
    <form @submit.prevent="handleSubmit">
        <input type="text" name="comment_text" v-model="form.comment_text" class="rounded-1 shadow mx-2 mt-0 w-100 h-50"
            style="border: none" required>

        <div class="d-flex justify-content-left">
            <button type="submit" class="btn btn-danger btn-sm bg-danger mx-2 h-50 mt-2">Submit</button>
        </div>

    </form>
    <div v-html="newComment">

    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['post-id'],

    data: function () {
        return {
            form: {
                'comment_text': ''
            },
            newComment: ''
        }
    },

    methods: {
        handleSubmit() {
            axios.post('/comment/' + this.postId, this.form)
                .then(response => {
                    console.log(response.data);

                    this.newComment = '<div class="bg-warning shadow rounded-4 m-2 py-1 pl-2">you have posted a comment pls refresh page to see it!</div>';
                }).catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }
                    console.log(errors);
                });
        }

    },
    computed: {

    }
}
</script>
