<script lang="ts">
    import { Link } from '@inertiajs/svelte'
    import Rave from './Partials/Rave.svelte'
    import NewRave from './Partials/NewRave.svelte'

    export let raves
</script>

<NewRave />

{#each raves.data as rave}
    <Rave {rave} />
{/each}

{#if raves.prev_page_url !== null}
    <Link href={raves.prev_page_url}>Previous</Link>
{/if}

{#if raves.next_page_url !== null}
    <Link href={raves.next_page_url}>Next</Link>
{/if}
