<script lang="ts">
    import { Link, page } from '@inertiajs/svelte'
    import 'normalize.css'

    $: isLoggedIn = $page.props.auth.user != null
</script>

<Link href="/">Home</Link><br />
{#if isLoggedIn}
    <Link href="/settings/account">{$page.props.auth.user.name}</Link><br />
{/if}
<br />
<slot />
