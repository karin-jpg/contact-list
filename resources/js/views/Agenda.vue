<template>
    <div class="container h-100 mt-4">
        <h1 class="mb-5"> Agenda </h1>
        <div class="row h-100 align-items-center">
            <div class="col-12">

                <router-link to="/criar-contato" type="button" class="btn btn-primary mb-3">Novo contato</router-link>
                <div v-if="requisicao.exibir" class="alert" :class="{'alert-success': requisicao.sucesso, 'alert-danger': !requisicao.sucesso}" role="alert">
                    {{ requisicao.mensagem }}
                </div>
                <table class="table">
                    <thead class="table-dark sticky-top">
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
                                <div class="d-flex">
                                    <div class="me-2">
                                        <router-link :to="{ name: 'editarContato', params: {id: usuario.id} }" type="button" class="btn btn-primary btn-sm">Editar</router-link>
                                    </div>
                                    <div>
                                        <button type="button" @click="prepararExclusao(usuario)" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal">Remover</button>
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
                        <h5 class="modal-title" id="modalLabel">Exclusão de contato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja realmente excluir o contato '{{ contatoRemocao.nome }}'? Esta ação não pode ser desfeita
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="removerContato()">Confirmar</button>
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
            contatoRemocao: {
                nome: '',
                id: ''
            },
            requisicao: {
                mensagem: '',
                sucesso: '',
                exibir: false
            }
        }
    },
    mounted() {
        this.buscarContatos()
    },
    methods:{
        buscarContatos() {
            this.usuarios = []
            axios.get('/api/usuarios')
            .then((resposta) => {
                this.usuarios = resposta.data
                this.usuarios = {...this.usuarios.usuarios}
            });
        },
        prepararExclusao(usuario) {
            this.contatoRemocao.nome = usuario.nome
            this.contatoRemocao.id = usuario.id
        },
        removerContato() {
            axios.delete('/api/usuarios/'+this.contatoRemocao.id)
            .then((resposta) => {
                this.buscarContatos();
                this.exibirAlerta(resposta.data.message, true)

            })
            .catch((error) => {
                console.log(error)
                this.exibirAlerta(error.response.data.error, false)
            });
        },

        exibirAlerta(mensagem, sucesso) {
            this.requisicao.mensagem = mensagem;
            this.requisicao.exibir = true;
            this.requisicao.sucesso = sucesso
            setTimeout(() => {
                this.requisicao.exibir = false;
            }, 5000)
        }
    }
}
</script>
