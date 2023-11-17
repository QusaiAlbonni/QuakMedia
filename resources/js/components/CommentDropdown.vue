
<template>
    <div class="dropdown mx-4">
        <button class="btn" type="button" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <svg width="15px" height="15px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                class="bi bi-three-dots-vertical">
                <path
                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>

        </button>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="background-color: white;">

            <li><button class="dropdown-item text-danger hover-shadow" @click="delCom">delete</button></li>
            <li><button class="dropdown-item text-primary" @click="editCom">edit</button></li>

        </ul>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    props: ['cid', 'comrep'],

    data: function () {
        return {
            isOpen: false
        }
    },
    methods: {

        delCom() {
            axios.delete('/' + this.comrep + '/' + this.cid)
                .then(response => {
                    console.log(response.data);
                    var comment = document.getElementById(this.comrep + this.cid);
                    console.log(this.comrep + this.cid);
                    comment.style.display = "none";
                    console.log(comment.style.display);
                }).catch(errors => {
                    console.error(errors);
                })
        },
        editCom() {
            console.log(this.cid);
            let comment = document.getElementById(this.comrep + this.cid);
            comment.style.display = "none";
            let commentedi = document.getElementById(this.comrep + "Edit" + this.cid);
            console.log(commentedi);
            if (this.comrep === 'reply') {
                this.$root.replyEditsEnabled[this.cid] = true;
            }
            else if (this.comrep === 'comment') {
                this.$root.editsEnabled[this.cid] = true;
            }
        }

    },
    computed: {
        activate() {
            return this.isOpen;
        },
    }
};
</script>

