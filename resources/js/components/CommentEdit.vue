
<template>
    <div>
        <div>

            <div class="d-flex justify-content-left">
                <div class="mx-2" style="width: 40px; height: 50px">
                    <img class="w-100 rounded-circle" :src="imgpath" style="width: 8px">
                </div>
                <div class="w-100">
                    <input class="rounded-4 py-0 px-2 m-2 w-100 h-75" v-model="form.comment_text" type="text"
                        style="border: none; box-shadow: none">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="bg-danger text-white rounded-5 shadow ml-1 p-1 px-2 mr-1" @click="cancel">
                    <p class="p-0 m-0" style="font-size: 12px">Cancel
                    </p>
                </button>
                <button type="submit" @click="handleSubmit"
                    class="bg-primary text-white rounded-5 shadow ml-1 p-1 px-2 mr-2">
                    <p class="p-0 m-0" style="font-size: 12px">save
                    </p>
                </button>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    props: ['cid', 'comrep', 'img', 'oct'],

    data: function () {
        return {
            isOpen: false,
            form: {
                comment_text: this.oct,
            }
            ,
            imgpath: "/storage/" + this.img,

        }
    },
    methods: {
        cancel() {
            console.log(this.cid);
            let comment = document.getElementById(this.comrep + this.cid);
            console.log(comment);
            comment.style.display = "inline";
            if (this.comrep === 'comment') {
                this.$root.editsEnabled[this.cid] = false;
            }
            else if (this.comrep === 'reply') {
                this.$root.replyEditsEnabled[this.cid] = false;
            }
        },
        handleSubmit() {
            axios.patch('/' + this.comrep + '/update/' + this.cid, this.form)
                .then(response => {
                    console.log('weeee');
                    console.log(response.data);
                    if (this.comrep === 'comment') {
                        this.$root.editsEnabled[this.cid] = false;
                    }
                    else if (this.comrep === 'reply') {
                        this.$root.replyEditsEnabled[this.cid] = false;
                    }
                    let comment = document.getElementById(this.comrep + this.cid);
                    let commenttext = document.getElementById(this.comrep + "text" + this.cid);
                    commenttext.textContent = response.data.new_comment;
                    comment.style.display = 'inline';
                    this.form.comment_text = response.data.new_comment;
                }).catch(errors => {
                    console.log(errors);
                });
        },

    },
};
</script>

