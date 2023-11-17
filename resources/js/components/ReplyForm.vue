<template>
    <form @submit.prevent="handleSubmit">

        <div class="d-flex justify-content-left">
            <div class="mx-2" style="width: 40px; height: 40px">
                <img class="w-100 rounded-circle" :src="imgpath" style="width: 8px">
            </div>
            <div class="w-100">
                <input class="rounded-5 py-0 px-2 m-2 w-100" v-model="form.text" type="text"
                    style="border: none; box-shadow: none" placeholder="Add a reply..." name="text">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" class="bg-danger text-white rounded-5 shadow ml-1 p-1 px-2 mr-1" @click="cancel">
                <p class="p-0 m-0" style="font-size: 12px">Cancel
                </p>
            </button>
            <button type="submit" class="bg-primary text-white rounded-5 shadow ml-1 p-1 px-2 mr-2">
                <p class="p-0 m-0" style="font-size: 12px">reply
                </p>
            </button>
        </div>
    </form>
    <div v-html="newComment">

    </div>
</template>

<script>
import axios from 'axios';



export default {
    props: ['comment-id', 'img'],

    data: function () {
        return {
            form: {
                'text': ''
            },
            newComment: '',
            imgpath: "/storage/" + this.img
        }
    },

    methods: {
        handleSubmit() {
            axios.post('/reply/' + this.commentId, this.form)
                .then(response => {
                    console.log(response.data);

                    this.newComment = '<div class="bg-warning shadow rounded-4 m-2 py-1 pl-2">you have posted a reply pls refresh page to see it!</div>';
                }).catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }
                    console.log(errors);
                });
        },
        cancel() {
            console.log(this.commentId);
            var addreply = document.getElementById("addreply" + this.commentId);
            if (addreply.style.display === 'inline') {
                addreply.style.display = "none";
            }
        }

    },
    computed: {

    }
}
</script>
