<template>
    <div class="container h-100 mt-4">
        <h1 class="mb-5"> Agenda </h1>
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <router-link to="/form" type="button" class="btn btn-primary">Editar contato</router-link>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Cep</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Número</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuarios">
                            <th scope="row">1</th>
                            <td class="align-middle">{{ usuario.nome }}</td>
                            <td class="align-middle">{{ usuario.telefone }}</td>
                            <td class="align-middle">{{ usuario.email }}</td>
                            <td class="align-middle">{{ usuario.cep }}</td>
                            <td class="align-middle">{{ usuario.estado }}</td>
                            <td class="align-middle">{{ usuario.cidade }}</td>
                            <td class="align-middle">{{ usuario.bairro }}</td>
                            <td class="align-middle">{{ usuario.endereco }}</td>
                            <td class="align-middle">{{ usuario.endereco_numero }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <button type="button" class="btn btn-primary">Editar contato</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-danger">Remover contato</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            usuarios: []
        }
    },
    mounted() {
        this.buscarContatos()
    },
    methods:{
        buscarContatos(){

            axios.get('/api/usuarios')
            .then((resposta) => {
                this.usuarios = resposta.data
                this.usuarios = {...this.usuarios.usuarios}
            });
        }
    }
}
</script>
