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
                            class="mb-3 text-xs font-semibold tracking-wide uppercase"
                        >
                            <span class="text-base-content">{{ post.user.name }} - {{ diffForHumans(post.created_at) }}
                            </span>
                        </p>
                        <a
                            href="/"
                            class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200"
                            >{{ post.title }}</a
                        >
                        <p class="mb-2 text-base-content">
                            {{ limitPostBody(post.body) }}
                        </p>
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
});

let posts = ref([]);
const hasMorePages = ref(true);
let page = 1;

const categorySlug = props.categorySlug;

const load = async ($state) => {
    try {
        let apiUrl = `/load-more-posts?page=${page}`;

        if (categorySlug) {
            apiUrl = `/post-category/${categorySlug}/load-more?page=${page}`;
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
