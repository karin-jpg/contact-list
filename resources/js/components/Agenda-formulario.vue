<template>
    <div class="container h-100 mt-4">
        <h1>Novo contato</h1>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="nome" v-model="formulario.nome" class="form-control">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="foxrm-label">Email</label>
                <input type="text" v-model="formulario.email" class="form-control">
            </div>
            <div class="col">
                <label for="telefone" class="foxrm-label">Telefone</label>
                <input type="text" v-mask="['(##) ####-####', '(##) #####-####']" v-model="formulario.telefone" class="form-control" name="telefone">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label class="foxrm-label">Cep</label>
                <input type="text" v-mask="'#####-###'" v-model="formulario.cep" class="form-control" @change="buscarCep()">
            </div>
            <div class="col-2">
                <label class="foxrm-label">Estado</label>
                <input type="text" v-model="formulario.estado" class="form-control" disabled>
            </div>
            <div class="col-8">
                <label class="foxrm-label">Cidade</label>
                <input type="text" v-model="formulario.cidade" class="form-control" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-5">
                <label class="foxrm-label">Bairro</label>
                <input type="text" v-model="formulario.bairro" class="form-control" disabled>
            </div>
            <div class="col-5">
                <label class="foxrm-label">Endereço</label>
                <input type="text" v-model="formulario.endereco" class="form-control" disabled>
            </div>
            <div class="col-2">
                <label class="foxrm-label">Número</label>
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
            }
        }
    },
    mounted() {

    },
    methods:{
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
