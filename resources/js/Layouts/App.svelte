<script lang="ts">
    import { Link, page } from '@inertiajs/svelte'
    import 'normalize.css'

    $: isLoggedIn = $page.props.auth.user != null
</script>

<div class="wrapper">
    <Link href="/">Home</Link><br />
    {#if isLoggedIn}
        <Link href="/settings/account">{$page.props.auth.user.name}</Link><br />
    {/if}
    <br />
    <main>
        <slot />
    </main>
</div>

<style lang="scss">
    .wrapper {
        margin: 0 auto;
        max-width: 1000px;
        padding: 0 1rem;
    }
</style>
