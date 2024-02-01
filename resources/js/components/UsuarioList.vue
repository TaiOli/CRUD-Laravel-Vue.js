<template>
  <div>
    <div class="mb-3">
      <label for="search" class="form-label">Pesquisar:</label>
      <input class="form-control" placeholder="Pesquisar por: Nome, CPF e Data do Cadastro" type="text" id="search" v-model="searchQuery" />
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">CPF</th>
          <th scope="col">Perfil</th>
          <th scope="col">Endereço</th>
          <th scope="col">Endereço Alternativo</th>
          <th scope="col">Data de Cadastro</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in filteredUsuarios" :key="usuario.id">
          <td>{{ usuario.id }}</td>
          <td>{{ usuario.nome }}</td>
          <td>{{ usuario.email }}</td>
          <td>{{ usuario.cpf }}</td>
          <td>{{ usuario.perfil }}</td>
          <td>{{ usuario.endereco }}</td>
          <td>{{ usuario.endereco_alternativo }}</td>
          <td>{{ formatarData(usuario.created_at) }}</td>
          <td>
            <div class="row gap-3">
              <router-link :to="`/usuarios/${usuario.id}`" class="p-2 col border btn btn-primary">Visualizar</router-link>
              <router-link :to="`/usuarios/${usuario.id}/edit`" class="p-2 col border btn btn-success">Editar</router-link>
              <button @click="deleteUsuario(usuario.id)" type="button" class="p-2 col border btn btn-danger">Excluir</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuarios: [],
      searchQuery: ''
    };
  },
  async created() {
    try {
      const response = await axios.get('/api/usuarios');
      this.usuarios = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  computed: {
    filteredUsuarios() {
      if (!this.searchQuery) {
        return this.usuarios;
      }
      const query = this.searchQuery.toLowerCase();
      return this.usuarios.filter(usuario =>
        usuario.nome.toLowerCase().includes(query) ||
        usuario.cpf.includes(query) ||
        this.formatarData(usuario.created_at).toString().includes(query)
      );
    }
  },
  methods: {
    async deleteUsuario(id) {
      try {
        await axios.delete(`/api/usuarios/${id}`);
        this.usuarios = this.usuarios.filter(usuario => usuario.id !== id);
      } catch (error) {
        console.error(error);
      }
    },
    formatarData(data) {
      const dataFormatada = new Date(data);
      return dataFormatada.toLocaleDateString();
    }
  }
};
</script>