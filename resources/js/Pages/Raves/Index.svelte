<script lang="ts">
    import { Link } from '@inertiajs/svelte'
    import Rave from './Partials/Rave.svelte'
    import { Rave as RaveType } from '@/types'
    import NewRave from './Partials/NewRave.svelte'

    export let raves: {
        data: RaveType[]
        prev_page_url: string
        next_page_url: string
    }
    console.table(raves.data[0])
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
