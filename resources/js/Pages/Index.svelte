<script lang="ts">
    import { Link, inertia, page } from '@inertiajs/svelte'

    $: isLoggedIn = $page.props.auth.user != null
</script>

Hello World<br />

{#if isLoggedIn}
    <button use:inertia={{ href: '/logout', method: 'post' }}>Logout</button>
{:else}
    <Link href="/login">Login</Link>
{/if}
