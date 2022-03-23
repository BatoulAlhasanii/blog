<template>
    <li class="list-group-item py-3">
        <div class="d-flex flex-start">
        
            <div class="flex-grow-1 flex-shrink-1">
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">{{ comment.user_name }}</p>
                    </div>
                    <p class="small mb-0">{{ comment.content }}</p>
                </div>
                
                <CommentForm 
                    v-if="level !== 3"
                    :parent_id="comment.id"
                    @comment-created="$emit('comment-created')"
                />

                <CommentList
                    v-if="grouped_comments[comment.id]"
                    :grouped_comments="grouped_comments"
                    :comment_group="grouped_comments[comment.id]"
                    :level="level + 1"
                    @comment-created="$emit('comment-created')"
                />

            </div>
        </div>

        
    </li>

</template>

<script>
import CommentForm from './form.vue';

export default {
    name: 'Comment',
    props: [
        'comment',
        'grouped_comments',
        'level'
    ],
    components: {
        CommentForm
    }
}
</script>