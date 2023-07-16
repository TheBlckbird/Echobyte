<script>
    import { useForm, Link } from '@inertiajs/svelte'

    let registerForm = useForm({
        name: null,
        password: null,
        password_confirmation: null
    })

    function register() {
        $registerForm.post('/register', {
            onFinish: () => $registerForm.reset('password', 'password_confirmation')
        })
    }
</script>

<div class="register">
    <form on:submit|preventDefault={register}>
        <p>
            <label>
                Name:<br />
                <input type="text" bind:value={$registerForm.name} />

                {#if $registerForm.errors.name}
                    <div class="register-form-error">{$registerForm.errors.name}</div>
                {/if}
            </label>
        </p>

        <p>
            <label>
                Password:<br />
                <input type="password" bind:value={$registerForm.password} maxlength="32" />

                {#if $registerForm.errors.password}
                    <div class="register-form-error">{$registerForm.errors.password}</div>
                {/if}
            </label>
        </p>

        <p>
            <label>
                Repeat Password:<br />
                <input type="password" bind:value={$registerForm.password_confirmation} />
            </label>
        </p>

        <button type="submit" disabled={$registerForm.processing}>register</button>
    </form>
    <Link href="/login">Login</Link>
</div>
