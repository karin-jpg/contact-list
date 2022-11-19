<template>
    <div class="container h-100 mt-4">
        <div class="row h-100 align-items-center">
            <div class="col-12">
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuarios">
                            <th scope="row">1</th>
                            <td>{{ usuario.nome }}</td>
                            <td>{{ usuario.telefone }}</td>
                            <td>{{ usuario.email }}</td>
                            <td>{{ usuario.cep }}</td>
                            <td>{{ usuario.estado }}</td>
                            <td>{{ usuario.cidade }}</td>
                            <td>{{ usuario.bairro }}</td>
                            <td>{{ usuario.endereco }}</td>
                            <td>{{ usuario.endereco_numero }}</td>
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
