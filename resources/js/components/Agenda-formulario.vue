<template>
    <div class="container h-100 mt-4">
        <h1>{{ textoTela.titulo }}</h1>
        <div v-if="requisicao.exibir" class="alert" :class="{'alert-success': requisicao.sucesso, 'alert-danger': !requisicao.sucesso}" role="alert">
                    {{ requisicao.mensagem }}
                </div>
        <form class="row">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label">Nome</label>
                    <input type="nome" v-model="formulario.nome" class="form-control" :class="{'border border-danger': validacaoFormulario.nome.erro}">
                    <small class="text-danger"> {{validacaoFormulario.nome.mensagem}} </small>
                </div>
                <div class="col-4">
                    <label class="form-label">Email</label>
                    <input type="text" v-model="formulario.email" class="form-control" :class="{'border border-danger': validacaoFormulario.email.erro}">
                    <small class="text-danger">{{validacaoFormulario.email.mensagem}}</small>
                </div>
                <div class="col-2">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" v-mask="['(##) ####-####', '(##) #####-####']" v-model="formulario.telefone" class="form-control" :class="{'border border-danger': validacaoFormulario.telefone.erro}">
                    <small class="text-danger">{{validacaoFormulario.telefone.mensagem}}</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <label class="form-label">Cep</label>
                    <input type="text" v-mask="'#####-###'" v-model="formulario.cep" class="form-control" :class="{'border border-danger': validacaoFormulario.cep.erro}" @blur="buscarCep()">
                    <small class="text-danger">{{validacaoFormulario.cep.mensagem}}</small>
                </div>
                <div class="col-2">
                    <label class="form-label">Estado</label>
                    <select class="form-select" :class="{'border border-danger': validacaoFormulario.estado.erro}" v-model="formulario.estado" aria-label="Default select example">
                        <option v-for="estado in estados" :value="estado.value">{{ estado.text }}</option>
                    </select>
                    <small class="text-danger">{{validacaoFormulario.estado.mensagem}}</small>
                </div>
                <div class="col-8">
                    <label class="form-label">Cidade</label>
                    <input type="text" v-model="formulario.cidade" :class="{'border border-danger': validacaoFormulario.cidade.erro}" class="form-control">
                    <small class="text-danger">{{validacaoFormulario.cidade.mensagem}}</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <label class="form-label">Bairro</label>
                    <input type="text" v-model="formulario.bairro" class="form-control" :class="{'border border-danger': validacaoFormulario.bairro.erro}">
                    <small class="text-danger">{{validacaoFormulario.cidade.mensagem}}</small>
                </div>
                <div class="col-5">
                    <label class="form-label">Endereço</label>
                    <input type="text" v-model="formulario.endereco" class="form-control" :class="{'border border-danger': validacaoFormulario.endereco.erro}">
                    <small class="text-danger">{{validacaoFormulario.cidade.mensagem}}</small>
                </div>
                <div class="col-2">
                    <label class="form-label">Número</label>
                    <input type="text" v-mask="'#####'" v-model="formulario.endereco_numero" class="form-control" :class="{'border border-danger': validacaoFormulario.endereco_numero.erro}">
                    <small class="text-danger">{{validacaoFormulario.endereco_numero.mensagem}}</small>
                </div>
            </div>
            <div class="d-flex">
                <div>
                    <router-link to="/" type="button" class="btn btn-danger me-2">Voltar</router-link>
                </div>
                <div>
                    <button type="button" @click="validarFormulario()" class="btn" :class="{'btn-primary': !modoEdicao, 'btn-warning': modoEdicao}" :disabled="desabilitarBotaoFormulario">{{ textoTela.botaoConfirmar }}</button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    data(){
        return {

            desabilitarBotaoFormulario: false,
            requisicao: {
                mensagem: '',
                sucesso: true,
                exibir: false
            },
            formulario: {
                id:'',
                nome: '',
                telefone: '',
                email: '',
                cep: '',
                estado: '',
                cidade: '',
                bairro: '',
                endereco: '',
                endereco_numero: '',
            },
            validacaoFormulario: {
                nome: {
                    mensagem: '',
                    erro: false
                },
                telefone: {
                    mensagem: '',
                    erro: false
                },
                email: {
                    mensagem: '',
                    erro: false
                },
                cep: {
                    mensagem: '',
                    erro: false
                },
                estado: {
                    mensagem: '',
                    erro: false
                },
                cidade: {
                    mensagem: '',
                    erro: false
                },
                bairro: {
                    mensagem: '',
                    erro: false
                },
                endereco: {
                    mensagem: '',
                    erro: false
                },
                endereco_numero: {
                    mensagem: '',
                    erro: false
                }
            },
            estados: [],
            textoTela: {
                titulo: '',
                botaoConfirmar: ''
            }
        }
    },
    props: {
        modoEdicao: {
            type: Boolean,
            default: false
        },
        contatoId: {
            type: String,
            default: null
        }
    },
    mounted(){
        if(this.modoEdicao) {
            this.buscarDadosContato();
        }

        this.validacaoAcaoTela();
        this.listarEstados();
    },
    methods:{
        listarEstados(){
            axios.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
            .then((resposta) => {
                resposta.data.forEach(estado => {
                    this.estados.push({
                        value: estado.sigla,
                        text: estado.sigla
                    })
                });
            })
            .catch(erro => {
                console.log(erro.response.data)
            });
        },
        buscarCep(){

            axios.get('https://cep.awesomeapi.com.br/json/'+this.formulario.cep)
            .then((resposta) => {
                this.formulario.estado = resposta.data.state
                this.formulario.cidade = resposta.data.city
                this.formulario.bairro = resposta.data.district
                this.formulario.endereco = resposta.data.address_name
            })
            .catch(erro => {
                this.validacaoFormulario.cep.mensagem = 'Cep inválido!'
                this.validacaoFormulario.cep.erro = true
                this.formulario.estado = ''
                this.formulario.cidade = ''
                this.formulario.bairro = ''
                this.formulario.endereco = ''
            });
        },

        validacaoAcaoTela(){
            if (this.modoEdicao) {
                this.textoTela.titulo = 'Editar contato'
                this.textoTela.botaoConfirmar = 'Atualizar'
                return;
            }

            this.textoTela.titulo = 'Novo contato'
            this.textoTela.botaoConfirmar = 'Cadastrar'
            return

        },

        validarFormulario(){
            this.desabilitarBotaoFormulario = true;

            for (const key in this.validacaoFormulario) {
                this.validacaoFormulario[key].mensagem = ''
                this.validacaoFormulario[key].erro = false
            }

            let erro = false;

            if (this.formulario.nome == ''){
                this.validacaoFormulario.nome.mensagem = 'O campo nome não pode estar vazio!'
                this.validacaoFormulario.nome.erro = true
                erro = true;
            }

            if (this.formulario.email == ''){
                this.validacaoFormulario.email.mensagem = 'O campo email não pode estar vazio!'
                this.validacaoFormulario.email.erro = true
                erro = true;
            }

            if (this.formulario.telefone == ''){
                this.validacaoFormulario.telefone.mensagem = 'O campo telefone não pode estar vazio!'
                this.validacaoFormulario.telefone.erro = true
                erro = true;
            }

            if (this.formulario.telefone.length < 14 && this.formulario.telefone != ''){
                this.validacaoFormulario.telefone.mensagem = 'Campo telefone inválido!'
                this.validacaoFormulario.telefone.erro = true
                erro = true;
            }

            if (this.formulario.cep == ''){
                this.validacaoFormulario.cep.mensagem = 'O campo cep não pode estar vazio!'
                this.validacaoFormulario.cep.erro = true
                erro = true;
            }

            if (this.formulario.cep.length < 9 && this.formulario.cep != ''){
                this.validacaoFormulario.cep.mensagem = 'Campo cep inválido!'
                this.validacaoFormulario.cep.erro = true
                erro = true;
            }

            if (this.formulario.estado == ''){
                this.validacaoFormulario.estado.mensagem = 'O campo estado não pode estar vazio!'
                this.validacaoFormulario.estado.erro = true
                erro = true;
            }

            if (this.formulario.cidade == ''){
                this.validacaoFormulario.cidade.mensagem = 'O campo cidade não pode estar vazio!'
                this.validacaoFormulario.cidade.erro = true
                erro = true;
            }

            if (this.formulario.bairro == ''){
                this.validacaoFormulario.bairro.mensagem = 'O campo bairro não pode estar vazio!'
                this.validacaoFormulario.bairro.erro = true
                erro = true;
            }

            if (this.formulario.endereco == ''){
                this.validacaoFormulario.endereco.mensagem = 'O campo endereco não pode estar vazio!'
                this.validacaoFormulario.endereco.erro = true
                erro = true;
            }

            if (this.formulario.endereco_numero == ''){
                this.validacaoFormulario.endereco_numero.mensagem = 'O campo número não pode estar vazio!'
                this.validacaoFormulario.endereco_numero.erro = true
                erro = true;
            }

            if (erro) {
                this.desabilitarBotaoFormulario = false;
                return;
            }

            this.enviarFormulario()
        },

        enviarFormulario(){
            if (this.modoEdicao){
                this.atualizarContato();
                return;
            }

            this.cadastrarContato();

        },

        buscarDadosContato(){
            axios.get('/api/usuarios/'+this.contatoId)
            .then((resposta) => {
                this.formulario = resposta.data.usuario
            });
        },

        cadastrarContato(){

            axios.post('/api/usuarios', this.formulario)
            .then((resposta) => {
                this.exibirAlerta(resposta.data.message + " Redirecionando à tela inicial", true)
                setTimeout(() => this.$router.push('/'), 3000);

            })
            .catch(erro => {
                for (const key in erro.response.data.errors) {
                    this.validacaoFormulario[key].mensagem = erro.response.data.errors[key][0]
                    this.validacaoFormulario[key].erro = false
                }
                this.desabilitarBotaoFormulario = false;
                this.exibirAlerta("Erro ao realizar cadastro", false);

            });
        },

        atualizarContato(){

            axios.put('/api/usuarios/'+this.contatoId, this.formulario)
            .then((resposta) => {
                this.exibirAlerta(resposta.data.message + " Redirecionando à tela inicial", true)
                setTimeout(() => this.$router.push('/'), 3000);
            })
            .catch(erro => {
                for (const key in erro.response.data.errors) {
                    this.validacaoFormulario[key].mensagem = erro.response.data.errors[key][0]
                    this.validacaoFormulario[key].erro = false
                }

                this.desabilitarBotaoFormulario = false;
                this.exibirAlerta("Erro ao realizar cadastro", false);


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
