<template>
    <div class="mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl py-4">
        <div
            class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 sm:mx-auto lg:max-w-full"
        >
            <div v-for="post in posts" :key="post.id">
                <div
                    class="overflow-hidden transition-shadow duration-300 rounded shadow-sm"
                >
                    <img
                        :src="post.image ? `${post.image}` : 'default.jpg'"
                        class="object-cover w-full h-48 sm:h-56"
                        alt=""
                    />
                    <div class="pt-5">
                        <p
                            class="mb-3 text-xs font-semibold tracking-wide uppercase flex justify-between"
                        >
                            <span class="text-base-content">{{ post.user.name }} - {{ diffForHumans(post.created_at) }}
                            </span>
                            <div class="flex space-x-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg><span>{{ post.likes_count }}</span>
                            </div>
                        </p>
                         <Link :href="`/post/${post.id}`">
                            <h2
                                class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200"
                                >{{ post.title }}</h2
                            >
                            <p class="mb-2 text-base-content">
                                {{ limitPostBody(post.body) }}
                            </p>
                        </Link>
                        <div class="mt-4 space-x-2">
                            <div
                                class="badge badge-outline border-2 border-secondary-focus text-base-content"
                            >
                                {{ post.category.name }}
                            </div>
                            <div
                                class="badge badge-outline border-2 text-base-content"
                            >
                                #tutorial
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <infinite-loading
            @infinite="load"
            :infinite-disabled="!hasMorePages"
            class="flex justify-center mt-4 text-xl font-medium"
        />
    </div>
</template>
<script setup>
import { ref } from "vue";

const props = defineProps({
    categorySlug: String,
    filter: String,
});

let posts = ref([]);
const hasMorePages = ref(true);
let page = 1;

let categorySlug = props.categorySlug;

const filter = props.filter;

const load = async ($state) => {
    try {
       let apiUrl = filter ? `/posts/${filter}/load?page=${page}` : `/load-more-posts?page=${page}`;


        if (categorySlug) {
            apiUrl = `/post-category/${categorySlug}/load-more?page=${page}`;
        }
        if(filter) {
            categorySlug = null;
            apiUrl = `/posts/${filter}/load?page=${page}`;
        }

        const response = await fetch(apiUrl);
        const json = await response.json();
       

        if (json.data.data.length === 0) {
            hasMorePages.value = false;
            $state.complete();
        } else {
            posts.value.push(...json.data.data);
            $state.loaded();
        }
        page++;
    } catch (error) {
        console.error(error);
        $state.error();
    }
};

const limitPostBody = (body) => {
    // Hapus tag HTML dengan regex
    const bodyWithoutTags = body.replace(/<[^>]+>/g, "");

    // Tambahkan <br> menjadi newline
    const bodyWithLineBreaks = bodyWithoutTags.replace(/\n/g, "<br>");

    // Batasi panjang teks menjadi 90 karakter
    return bodyWithLineBreaks.substring(0, 90);
};

const diffForHumans = (createdAt) => {
    const currentTime = new Date();
    const postTime = new Date(createdAt);
    const timeDifference = currentTime - postTime;
    const seconds = Math.floor(timeDifference / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (days > 0) {
        return `${days} days ago`;
    } else if (hours > 0) {
        return `${hours} hours ago`;
    } else if (minutes > 0) {
        return `${minutes} minutes ago`;
    } else {
        return `${seconds} seconds ago`;
    }
};
</script>
