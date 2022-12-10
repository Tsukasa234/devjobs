<template>
    <button class="text-teal-600 hover:text-teal-900 mr-5" @click="eliminarVacante">Eliminar</button>
</template>

<script>
    export default{
        props: ['vacanteId'],
        methods:{
            eliminarVacante(){
                    this.$swal({
                        title: '¿Estas seguro?',
                        text: "¡o podras ser capaz de revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si,¡Borralo!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const params = {
                                id: this.vacanteId,
                                _method: 'delete'
                            }
                            axios.post(`/vacantes/${this.vacanteId}`, params)
                            .then(respuesta =>{
                                    this.$swal.fire(
                                    '¡Eliminado!',
                                    respuesta.data.mensaje,
                                    'success'
                                )

                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                            })
                            .catch(error => {
                                console.login(error);
                            });
                    }
                })
            }
        }
    }
</script>

