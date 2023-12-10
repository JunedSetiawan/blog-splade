import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import "@protonemedia/laravel-splade/dist/jodit.css";

import ThemeToggle from "./components/ThemeToggle.vue";
import PostLoad from "./components/PostLoad.vue";
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";


// import "ionicons/dist/ionicons.js";

import { createApp } from "vue/dist/vue.esm-bundler.js";

import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");


createApp({
    render: renderSpladeApp({ el })
})
.use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .component('theme-toggle', ThemeToggle)
    .component('post-load',PostLoad)
    .component('infinite-loading',InfiniteLoading)
    .mount(el);
