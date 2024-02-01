<template>
  <div>
    <h5>Nome:</h5>
    <h6>{{ usuario.nome }}</h6>
    <h5>Email:</h5>
    <p>{{ usuario.email }}</p>
    <h5>CPF:</h5>
    <p>{{ usuario.cpf }}</p>
    <h5>Perfil:</h5>
    <p>{{ usuario.perfil }}</p>
    <h5>Endereço:</h5>
    <p>{{ usuario.endereco }}</p>
    <h5>Endereço Alternativo:</h5>
    <p>{{ usuario.endereco_alternativo }}</p>
    <router-link :to="`/usuarios/${usuario.id}/edit`" class="btn btn-primary">Editar</router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuario: {}
    };
  },
  async created() {
    try {
      const response = await axios.get(`/api/usuarios/${this.$route.params.id}`);
      this.usuario = response.data;
    } catch (error) {
      console.error(error);
    }
  }
};
</script>