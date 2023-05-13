<template>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h1>Prueba Crud</h1>
                <b-button v-b-modal.modal size="sm" variant="primary">
                    Crear Registro
                </b-button>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="row in array" :key="row.id">
                        <td>{{ row.number }}</td>
                        <td>{{ row.nombre }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" v-b-modal.modal-modificar @click="ver(row.id)">Modificar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>

                        </td>
                      </tr>

                    </tbody>
                  </table>
            </div>
            <div class="col-md-1"></div>
        </div>
        <!-- /.content -->
        <!--Modal-crear-->
        <b-modal id="modal" size="lg"  ref="modal" @ok="enviar()">
            <template v-slot:modal-title>
                Crear
            </template>
            <div class="form-group">
                <label class="col-form-label" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" v-model="nombre" >
            </div>

        </b-modal>
        <!--/. Modal-crear-->
        <!--Modal-Modificar-->
        <b-modal id="modal-modificar" size="lg"  ref="modal" @ok="update()">
            <template v-slot:modal-title>
                Modificar
            </template>
            <div class="form-group">
                <label class="col-form-label" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" v-model="nombre" >
            </div>

        </b-modal>
        <!--/. Modal-Modificar-->
    </div>

</template>

<script>
    export default {

        data(){
            return{
                csrfToken : '',
                array : [],
                nombre : '',
                ver_obj : {},
                update_id : '',

            }
        },
        methods : {
            listar(){
                let me=this;
                var url= '/cruds';
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.array = respuesta;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            enviar(){
                let me=this;
                axios.post('/cruds',{
                    'nombre':this.nombre,
                    '_token':this.csrfToken
                })
                    .then(function (response) {
                        // handle success
                        me.listar();
                        me.nombre='';
                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },

            ver(id){
                let me=this;
                var url= '/cruds/'+id;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.ver_obj = respuesta;
                        me.nombre = me.ver_obj.nombre;
                        me.update_id = me.ver_obj.id;
                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            update(){
                let me=this;
                axios.put('/cruds/'+me.update_id,{
                    'nombre':this.nombre,
                    '_token':this.csrfToken
                })
                    .then(function (response) {
                        // handle success
                        me.listar();

                    })
                    .catch(function (error) {

                        console.log(error);
                    });

            }
        },
        mounted() {
            this.listar();
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content

        }
    }
</script>

<style>

</style>
