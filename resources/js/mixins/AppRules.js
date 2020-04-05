export default
{
    data()
    {
        return {
            rules:
            {
                select: [
                    v => !!v || 'Seleccione una Opcion (Dato Requerido)',
                ],
                mutiple: [
                    v =>  v.length > 0 || 'Seleccione una Opcion (Dato Requerido)',
                ],
                required: [
                    v => !!v || 'Dato Requerido',
                ],
                radio: [
                    v => !!v || 'Seleccione una Opcion (Requerido)',
                ],
                monto: [
                    v => !!v || 'Monto Requerido',
                ],
                fecha: [
                    v => !!v || 'Fecha Requerida',
                ],
                email: [
                    v => !!v || 'El Correo es Requerido',
                    v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'indicar un email válido'
                ],
                image:[
                    v => !v || v.size < 2000000 || 'Imagen debe tener menos de 2 MB!',
                ],
        
                password: [
                    v => !!v || 'La Contraseña es Requerida',
                    v => !!v && v.length > 7 || 'La contraseña debe tener almenos 6 caracteres'
                ],
                password_confirmation: [
                    v => this.form.password === v || 'Las contraseñas no coinciden'
                ],
            }
        }
    },
}
