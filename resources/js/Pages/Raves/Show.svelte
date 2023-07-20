<script lang="ts">
    import type { Rave as RaveType } from '@/types'
    import Rave from './Partials/Rave.svelte'
    import NewRave from './Partials/NewRave.svelte'

    export let rave: RaveType
</script>

<Rave {rave} standalone />

<NewRave raveId={rave.id} comment />

{#each rave.comments as comment}
    <Rave rave={comment} />
{:else}
    <p>No comments yet.</p>
{/each}
