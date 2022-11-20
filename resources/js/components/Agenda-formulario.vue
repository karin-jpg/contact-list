<template>
    <div class="container h-100 mt-4">
        <h1>Novo contato</h1>
        <div class="mb-3 mt-3">
            <label class="form-label">Nome</label>
            <input type="nome" v-model="formulario.nome" class="form-control">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Email</label>
                <input type="text" v-model="formulario.email" class="form-control">
            </div>
            <div class="col">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" v-mask="['(##) ####-####', '(##) #####-####']" v-model="formulario.telefone" class="form-control" name="telefone">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label class="form-label">Cep</label>
                <input type="text" v-mask="'#####-###'" v-model="formulario.cep" class="form-control" @blur="buscarCep()">
            </div>
            <div class="col-2">
                <label class="form-label">Estado</label>
                <select class="form-select" v-model="formulario.estado" aria-label="Default select example">
                    <option v-for="estado in estados" :value="estado.value">{{ estado.text }}</option>
                </select>
            </div>
            <div class="col-8">
                <label class="form-label">Cidade</label>
                <input type="text" v-model="formulario.cidade" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-5">
                <label class="form-label">Bairro</label>
                <input type="text" v-model="formulario.bairro" class="form-control">
            </div>
            <div class="col-5">
                <label class="form-label">Endereço</label>
                <input type="text" v-model="formulario.endereco" class="form-control">
            </div>
            <div class="col-2">
                <label class="form-label">Número</label>
                <input type="text" v-model="formulario.endereco_numero" class="form-control">
            </div>
        </div>
        <div class="d-flex">
            <div>
                <button type="button" @click="cadastrarContato()" class="btn btn-primary">{{ botaoTexto }}</button>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return {
            botaoTexto: 'Cadastrar',
            formulario: {
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
            estados: []
        }
    },
    props: {
        modoEdicao: {
            type: Boolean,
            default: false
        }
    },
    mounted(){
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
                console.log(erro.response.data)
            });
        },

        cadastrarContato(){

            // if(!this.formulario.endereco_numero) {
            //     delete(this.formulario.endereco_numero)
            // }

            axios.post('/api/usuarios', this.formulario)
            .then((resposta) => {
                alert(resposta.data.message)
                setTimeout(() => this.$router.push('/'), 1000);

            })
            .catch(erro => {
                alert('erro ao cadastrar')
                console.log(erro.response.data)
            });
        }
    }
}
</script>
