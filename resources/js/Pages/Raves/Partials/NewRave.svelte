<script lang="ts">
    import { useForm } from '@inertiajs/svelte'

    let newRaveForm = useForm({
        body: ''
    })

    function submitNewRaveForm() {
        $newRaveForm.post('/raves', {
            preserveScroll: true,
            onSuccess: () => $newRaveForm.reset('body')
        })
    }
</script>

<form on:submit|preventDefault={submitNewRaveForm}>
    <label>
        Body:<br />
        <textarea cols="80" rows="10" bind:value={$newRaveForm.body} />

        {#if $newRaveForm.errors.body}
            <div class="login-form-error">
                {$newRaveForm.errors.body}
            </div>
        {/if}
    </label>

    <button type="submit">Submit</button>
</form>
