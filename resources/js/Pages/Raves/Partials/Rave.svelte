<script lang="ts">
    import ConditionalLink from '@/Layouts/ConditionalLink.svelte'
    import { showReraves } from '@/stores'
    import { Rave } from '@/types'
    import { Link, router } from '@inertiajs/svelte'
    //@ts-ignore
    import copy from 'copy-to-clipboard'

    export let standalone = false
    export let rave: Rave

    let copyButtonText = 'Copy'

    function toggleLike() {
        fetch('/raves/' + rave.id + '/toggle-like', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? ''
            }
        })

        rave.likes_count += rave.is_liked ? -1 : 1
        rave.is_liked = !rave.is_liked
    }

    function setShowReraves() {
        showReraves.set(true)
        if (!standalone) {
            router.get('/raves/' + rave.id)
        }
    }

    function showComments() {
        showReraves.set(false)
    }

    function copyRave() {
        copy(rave.body)
        copyButtonText = 'Copied!'

        setTimeout(() => {
            copyButtonText = 'Copy'
        }, 1000)
    }

    function deleteRave() {
        if (confirm('Are you sure about that?')) {
            router.delete('/raves/' + rave.id)
        }
    }
</script>

<div class="rave">
    <ConditionalLink condition={!standalone} href="/raves/{rave.id}" class="content">
        <strong class="name">{rave.user.name}</strong>
        <div class="body">{rave.body}</div>

        {#if rave.original_rave != null}
            <Link href="/raves/{rave.original_rave.id}">
                <div class="rerave">
                    <div class="name">{rave.original_rave.user.name}</div>
                    <div class="body">{rave.original_rave.body}</div>
                    <!-- {JSON.stringify(rave.original_rave)} -->
                </div>
            </Link>
        {/if}
    </ConditionalLink>

    <div class="interactions">
        <button class="likes-count" on:click={toggleLike}>
            {rave.likes_count} Likes {#if rave.is_liked}
                liked
            {/if}
        </button>
        <button class="comments-count" on:click={showComments}>
            {#if standalone}
                {rave.comments.length}
            {:else}
                {rave.comments_count}
            {/if} Comments
        </button>
        <button class="rerave-count" on:click={setShowReraves}>
            {#if standalone}
                {rave.reraves.length}
            {:else}
                {rave.reraves_count}
            {/if} Reraves
        </button>
    </div>
    <div class="actions">
        <button on:click={copyRave}>{copyButtonText}</button>
        {#if rave.is_owner}
            <button on:click={deleteRave}>Delete</button>
        {/if}
    </div>
</div>

<style lang="scss">
    .rave {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 1rem;
        padding: 1rem;
        display: block;

        .name {
            font-weight: bold;
            display: inherit;
        }

        .interactions {
            display: flex;
            justify-content: space-between;
        }

        .rerave {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 1rem;
            padding: 1rem;
        }
    }

    :global(.content) {
        display: block;
    }
</style>
