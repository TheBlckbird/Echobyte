<script lang="ts">
    import type { Rave } from '../../../types'

    export let rave: Rave

    function toggleLike() {
        fetch('/raves/' + rave.id + '/toggle-like', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })

        rave.likes_count += rave.is_liked ? -1 : 1
        rave.is_liked = !rave.is_liked
    }
</script>

<div class="rave">
    <strong class="name">{rave.user.name}</strong>
    <div class="body">{rave.body}</div>
    <div class="interactions">
        <button class="likes-count" on:click={toggleLike}>
            {rave.likes_count} Likes {#if rave.is_liked}
                liked
            {/if}
        </button>
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
