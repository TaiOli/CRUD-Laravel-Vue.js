<template>
  <div>
    <h3 class="mt-2" v-if="isNewUsuario">Cadastro</h3>
    <h2 v-else>Editar Usuario</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-3 mt-5">
        <label for="nome" class="form-label">Nome:</label>
        <input class="form-control" type="text" id="nome" v-model="usuario.nome" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input class="form-control" id="email" v-model="usuario.email" required />
      </div>
      <div class="mb-3">
        <label for="cpf" class="form-label">CPF:</label>
        <input class="form-control" id="cpf" v-model="usuario.cpf" required />
      </div>
      <div class="mb-3">
        <label for="endereco" class="form-label">Endereco:</label>
        <input class="form-control" id="endereco" v-model="usuario.endereco" required />
      </div>
      <div class="mb-3">
        <label for="endereco_alternativo" class="form-label">Endereço Alternativo:</label>
        <input class="form-control" id="endereco_alternativo" v-model="usuario.endereco_alternativo" />
      </div>
      <div class="mb-3">
        <label for="perfil" class="form-label">Perfil:</label>
        <select class="form-select" id="perfil" v-model="usuario.perfil.perfil" required>
          <option value="administrador">Administrador</option>
          <option value="usuario">Usuário</option>
        </select>
      </div>
      <button type="submit" v-if="isNewUsuario" class="btn btn-primary">Adicionar Usuario</button>
      <button type="submit" v-else class="btn btn-primary">Atualizar Usuario</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuario: {
        nome: '',
        email: '',
        cpf: '',
        endereco: '',
        endereco_alternativo: '',
        perfil: {},
      },
    };
  },
  computed: {
    isNewUsuario() {
      return !this.$route.path.includes('edit');
    },
  },
  async created() {
    if (!this.isNewUsuario) {
        try {
            const response = await axios.get(`/api/usuarios/${this.$route.params.id}/edit`);
            this.usuario = response.data;
            
            if (typeof this.usuario.perfil === 'string') {
              this.usuario.perfil = { perfil: this.usuario.perfil };
            }
        } catch (error) {
            console.error(error);
        }
    }
},
  methods: {
    async submitForm() {
      try {
        if (this.isNewUsuario) {
          await axios.post('/api/usuarios', this.usuario);
        } else {
          await axios.put(`/api/usuarios/${this.$route.params.id}`, this.usuario);
        }
        this.$router.push('/');
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>