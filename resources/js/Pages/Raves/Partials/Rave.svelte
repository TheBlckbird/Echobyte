<script lang="ts">
    import Rave from './Rave.svelte'
    import { Link } from '@inertiajs/svelte'

    export let rave: Rave
    export let standalone = false

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

<!-- TODO: Fix  -->
{#if standalone}
    <div class="rave">
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
    </div>
{:else}
    <Link href="/raves/{rave.id}" class="rave">
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
    </Link>
{/if}

<style lang="scss">
    :global(.rave) {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 1rem;
        padding: 1rem;
        display: block;
    }

    .name {
        font-weight: bold;
    }

    .interactions {
        display: flex;
        justify-content: space-between;
    }
</style>
