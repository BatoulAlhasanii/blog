<template>

    <form class="mb-3">

        <div class="input-group input-group-sm">
            <input
                class="form-control mb-2 "
                :class="this.errors.user_name ? 'is-invalid' : ''"
                aria-describedby="inputGroup-sizing-sm"
                type="text"
                v-model="comment.user_name"
                placeholder="User Name"
            >
        </div>
        <div class="input-group input-group-sm">
            <textarea
                class="form-control mb-2"
                :class="this.errors.content ? 'is-invalid' : ''"
                aria-describedby="inputGroup-sizing-sm"
                v-model="comment.content"
                placeholder="Content"
            >
            </textarea>
        </div>

        <button @click.prevent="createComment" class="btn btn-outline-secondary  btn-sm">Reply</button>
    </form>

</template>

<script>
export default {
    name: 'CommentForm',
    props: {
        'parent_id': {
            default: null
        }
    },
    data() {
        return {
            comment: {
                user_name: '',
                content: '',
                parent_id: this.parent_id
            },
            validation_rules: {
                user_name: [(v) => !!v || 'User name field is required'],
                content: [(v) => !!v || 'Content field is required']
            },
            errors: {
                user_name: '',
                content: '',
            },
            is_input_valid: true
        }
    },
    methods: {
        createComment() {

            this.clearErrors()
            this.checkForm()

            if (!this.is_input_valid) {
                return
            }

            axios.post('/api/comments', this.comment)
            .then ((response) => {

                this.resetData()
                this.$emit('comment-created');

            }).catch((error) => {
                console.log(error);
            });

        },
        checkForm: function (e) {

            this.is_input_valid = true

            if (!this.comment.user_name) {
                this.errors.user_name = true
                this.is_input_valid = false
            }

            if (!this.comment.content) {
                this.errors.content = true
                this.is_input_valid = false
            }

        },
        resetData() {
            
            this.comment = {
                user_name: '',
                content: '',
                parent_id: this.parent_id
            }

            this.clearErrors()

            this.is_input_valid = true
            
        },
        clearErrors() {

            this.errors = {
                user_name: '',
                content: '',
            }
            
        }
    }
}
</script>