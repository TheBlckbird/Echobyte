<script>
    import { useForm, page } from '@inertiajs/svelte'

    let changeNameForm = useForm({
        name: $page.props.auth.user.name
    })

    function submitChangeNameForm() {
        $changeNameForm.post('/settings/account/name', {
            preserveScroll: true,
            onSuccess: () => {
                $changeNameForm.reset()
            }
        })
    }

    let changePasswordForm = useForm({
        old_password: '',
        new_password: '',
        new_password_confirmation: ''
    })

    function submitChangePasswordForm() {
        $changePasswordForm.post('/settings/account/password', {
            preserveScroll: true,
            onSuccess: () => {
                $changePasswordForm.reset()
            }
        })
    }

    let deleteUserForm = useForm({
        password: ''
    })

    function submitDeleteUserForm() {
        $deleteUserForm.delete('/settings/account/delete', {
            preserveScroll: true,
            onFinish: () => {
                $deleteUserForm.reset()
            }
        })
    }
</script>

<form on:submit|preventDefault={submitChangeNameForm}>
    <p>
        <label>
            Name:<br />
            <input type="text" bind:value={$changeNameForm.name} />

            {#if $changeNameForm.errors.name}
                <div class="login-form-error">
                    {$changeNameForm.errors.name}
                </div>
            {/if}
        </label>
    </p>

    <button type="submit" disabled={$changeNameForm.processing}>Save</button>
</form>

<form on:submit|preventDefault={submitChangePasswordForm}>
    <p>
        <label>
            Old Password:<br />
            <input type="password" bind:value={$changePasswordForm.old_password} />

            {#if $changePasswordForm.errors.old_password}
                <div class="login-form-error">
                    {$changePasswordForm.errors.old_password}
                </div>
            {/if}
        </label>
    </p>

    <p>
        <label>
            New Password:<br />
            <input type="password" bind:value={$changePasswordForm.new_password} />

            {#if $changePasswordForm.errors.new_password}
                <div class="login-form-error">
                    {$changePasswordForm.errors.new_password}
                </div>
            {/if}
        </label>
    </p>

    <p>
        <label>
            Confirm new Password:<br />
            <input type="password" bind:value={$changePasswordForm.new_password_confirmation} />

            {#if $changePasswordForm.errors.new_password_confirmation}
                <div class="login-form-error">
                    {$changePasswordForm.errors.new_password_confirmation}
                </div>
            {/if}
        </label>
    </p>

    <button type="submit" disabled={$changePasswordForm.processing}>Save</button>
</form>

<form on:submit|preventDefault={submitDeleteUserForm}>
    <p>
        <label>
            Password:<br />
            <input type="password" bind:value={$deleteUserForm.password} />

            {#if $deleteUserForm.errors.password}
                <div class="login-form-error">
                    {$deleteUserForm.errors.password}
                </div>
            {/if}
        </label>
    </p>

    <button type="submit" disabled={$deleteUserForm.processing}>Delete</button>
</form>
