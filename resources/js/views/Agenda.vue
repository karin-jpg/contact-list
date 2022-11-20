<template>
    <div class="container h-100 mt-4">
        <h1 class="mb-5"> Agenda </h1>
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <router-link to="/criar-contato" type="button" class="btn btn-primary">Novo contato</router-link>
                <table class="table">
                    <thead>
                        <tr>
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
                                        <button type="button" class="btn btn-primary btn-sm">Editar</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal">Remover</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ modalInfo.modalTitulo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ modalInfo.modalMensagem }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ modalInfo.modalBotaoCancela}}</button>
                        <button type="button" class="btn btn-primary">{{ modalInfo.modalBotaoConfirma }}</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            usuarios: [],
            modalInfo: {
                modalTitulo: '',
                modalMensagem: '',
                modalBotaoConfirma: '',
                modalBotaoCancela: '',
            }
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
