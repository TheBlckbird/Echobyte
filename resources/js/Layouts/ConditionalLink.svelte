<script lang="ts">
    import { Link } from '@inertiajs/svelte'

    export let condition = true
    export let href: string
</script>

{#if condition}
    <Link {href} {...$$restProps}>
        <slot />
    </Link>
{:else}
    <div {...$$restProps}>
        <slot />
    </div>
{/if}
