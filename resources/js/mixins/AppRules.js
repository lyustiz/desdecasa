export default
{
    data()
    {
        return {
            rules:
            {
        /*         length: len => v => (v || '').length >= len || `Invalid character length, required ${len}`,
                password: v => (v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
                'Password must contain an upper case letter, a numeric character, and a special character',
                required: v => !!v || 'This field is required',
                 */
                
                
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
                email_confirmation: [
                    v => this.form.tx_new_email === v || 'Los correos no coinciden'
                ],
                image:[
                    v => !v || v.size < 2000000 || 'Imagen debe tener menos de 2 MB!',
                ],
                coordinate:[
                    v => !v || v != 0 || 'Debe Seleccionar una Ubicacion',
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
