<template>
    <ul class="list-group">
        <Comment
            v-for="(comment, i) in comment_group"
            :key="i" :comment="comment"
            :grouped_comments="grouped_comments"
            :level="level"
        />
    </ul>
</template>

<script>
import Comment from './comment.vue';

export default {
    name: 'CommentList',
    props: [
        'grouped_comments',
        'comment_group',
        'level'
    ],
    components: {
        Comment
    }
}
</script>