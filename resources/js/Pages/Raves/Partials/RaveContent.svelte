<script lang="ts">
    import type { Rave } from '@/types'

    export let standalone = false
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

<strong class="name">{rave.user.name}</strong>
<div class="body">{rave.body}</div>
<div class="interactions">
    <button class="likes-count" on:click={toggleLike}>
        {rave.likes_count} Likes {#if rave.is_liked}
            liked
        {/if}
    </button>
    <button class="comments-count"
        >{#if standalone}
            {rave.comments.length}
        {:else}
            {rave.comments_count}
        {/if} Comments</button
    >
    <button class="rerave-count">{rave.reraves_count} Reraves</button>
</div>
