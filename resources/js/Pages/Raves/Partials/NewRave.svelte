<script context="module" lang="ts">
    export enum Type {
        Rave = 'rave',
        Comment = 'comment',
        Rerave = 'rerave'
    }
</script>

<script lang="ts">
    import { useForm } from '@inertiajs/svelte'

    export let type: Type = Type.Rave
    export let raveId = -1

    let newRaveForm = useForm({
        body: ''
    })

    function submitNewRaveForm() {
        let uri = ''

        switch (type) {
            case Type.Rave:
                uri = '/raves'
                break

            case Type.Comment:
                uri = `/raves/${raveId}/comments`
                break

            case Type.Rerave:
                uri = `/raves/${raveId}/reraves`
                break

            default:
                break
        }

        $newRaveForm.post(uri, {
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
