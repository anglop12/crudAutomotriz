<template>
    <div v-if="$store.state.auth">
        <h2>Bienvenido Administrador</h2>
    </div>
    <div v-else>
        <h2>Bienvenido inicia sesion por favor</h2>
    </div>
</template>

<script>
    export default {

    }
</script>
