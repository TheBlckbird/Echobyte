<script lang="ts">
    import { Rave } from '../../../types'

    export let rave: Rave

    console.log(rave.user)
</script>

<div class="rave">
    <strong class="name">{rave.user.name}</strong>
    <div class="body">{rave.body}</div>
    <div class="interactions">
        <button class="likes-count">{rave.likes_count} Likes</button>
        <button class="comments-count">{rave.comments_count} Comments</button>
        <button class="rerave-count">{rave.reraves_count} Reraves</button>
    </div>
</div>

<style lang="scss">
    .rave {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 1rem;
        padding: 1rem;
    }

    .name {
        font-weight: bold;
    }

    .interactions {
        display: flex;
        justify-content: space-between;
    }
</style>
