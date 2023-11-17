import './bootstrap';

import Alpine from 'alpinejs';

import '../sass/app.scss';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import FollowButton from "./components/FollowButton.vue";
import LikeButton from "./components/LikeButton.vue";
import CommentLikeButton from "./components/CommentLikeButton.vue";
import ReplyLikeButton from "./components/ReplyLikeButton.vue";
import CommentForm from "./components/CommentForm.vue";
import ReplyForm from "./components/ReplyForm.vue";
import CommentDropdown from "./components/CommentDropdown.vue";
import CommentEdit from "./components/CommentEdit.vue";



window.Alpine = Alpine;



Alpine.start();



const app = createApp({
    data() {
        return {
            editsEnabled: [],
            replyEditsEnabled: [],

        }
    },
});


app.component("follow", FollowButton);
app.component("like", LikeButton);
app.component("commentlike", CommentLikeButton);
app.component("replylike", ReplyLikeButton);
app.component("commentform", CommentForm);
app.component("replyform", ReplyForm);
app.component("commentdropdown", CommentDropdown);
app.component("commentedit", CommentEdit);


app.mount("#app");
