<template>
    <div>
        <section class="gradient-custom">
            <div class="container my-5 py-5">
                <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 pb-2">Post Title</h4>

                        <div class="row">
                            <div class="col">
                                
                                <div v-if="is_loading" class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                    </div>
                                </div>

                                <div v-else>
                                    <CommentList
                                        :grouped_comments="grouped_comments"
                                        :comment_group="grouped_comments['root']"
                                        :level="1"
                                        @comment-created="getComments"
                                    />
                                    <div class="py-3">

                                        <CommentForm
                                            @comment-created="getComments"
                                        />

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import CommentList from '../comments/list.vue';
import CommentForm from '../comments/form.vue';

export default {
    name: 'Post',
    components: {
        CommentList,
        CommentForm
    },
    data() {
        return {
            grouped_comments: '',
            is_loading: false
        }
    },
    created() {
        this.getComments()
    },
    methods: {
        getComments() {
            this.is_loading = true
            axios.get('/api/comments')
            .then ((response) => {

                this.is_loading = false
                this.grouped_comments = response.data.grouped_comments;

            }).catch((error) => {

                this.is_loading = false
                console.log(error);
            
            });
        }
    }
}
</script>