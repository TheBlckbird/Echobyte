<script>
    import { useForm, Link } from '@inertiajs/svelte'

    export let name

    let loginForm = useForm({
        name: name,
        password: null,
        remember: true
    })

    function login() {
        $loginForm.post('/login', {
            onFinish: () => $loginForm.reset('password')
        })
    }
</script>

<div class="login">
    <form on:submit|preventDefault={login}>
        <p>
            <label>
                Name:<br />
                <input type="name" bind:value={$loginForm.name} />

                {#if $loginForm.errors.name}
                    <div class="login-form-error">
                        {$loginForm.errors.name}
                    </div>
                {/if}
            </label>
        </p>

        <p>
            <label>
                Password:<br />
                <input type="password" bind:value={$loginForm.password} />

                {#if $loginForm.errors.password}
                    <div class="login-form-error">
                        {$loginForm.errors.password}
                    </div>
                {/if}
            </label>
        </p>

        <p>
            <label>
                Remember Me
                <input type="checkbox" bind:checked={$loginForm.remember} />
            </label>
        </p>

        <button type="submit" disabled={$loginForm.processing}>Login</button>
    </form>

    <Link href="/register">Create Account</Link><br />
    <Link href="/forgot-password">Forgot your password</Link><br />
</div>
