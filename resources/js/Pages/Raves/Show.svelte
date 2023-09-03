<script lang="ts">
    import type { Rave as RaveType } from '@/types'
    import { Type as NewRaveType } from './Partials/NewRave.svelte'
    import Rave from './Partials/Rave.svelte'
    import NewRave from './Partials/NewRave.svelte'
    import { showReraves } from '@/stores'

    export let rave: RaveType
</script>

<Rave {rave} standalone />

{#if $showReraves}
    <NewRave raveId={rave.id} type={NewRaveType.Rerave} />

    {#each rave.reraves as rerave}
        <Rave rave={rerave} />
    {:else}
        <p>No reraves yet.</p>
    {/each}
{:else}
    <NewRave raveId={rave.id} type={NewRaveType.Comment} />

    {#each rave.comments as comment}
        <Rave rave={comment} />
    {:else}
        <p>No comments yet.</p>
    {/each}
{/if}
