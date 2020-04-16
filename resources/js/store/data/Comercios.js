export default
{
	state(){
		return	{
			comercio: null,
			comercios: [ ],
		}
	},

	getters:
	{
        getComercios: state => state.comercios,
                
		countComercios: state => state.comercios.length,
		
		getComercio: state => state.comercio,
	},

	mutations:
	{
		setComercios (state, comercios)
        {
            state.comercios 	= comercios
        },

		delComercios (state, comercios)
        {
            state.comercios 	= comercios
		},

		insComercios(state, comercios)
        {
            state.comercios 	= comercios
		},
		setComercio (state, comercio)
        {
            state.comercio 	= comercio
        },
	},

	actions:
	{

		apiComerciosCategoria( { commit }, categoria )
		{
			axios.get('/api/v1/' + 'comercio/categoria/' + categoria)
			.then( response =>
			{
				commit('setComercios', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		},

		apiComercioUsuario( { commit }, idUsuario )
		{
			return new Promise((resolve, reject) => 
			{
				axios.get('/api/v1/' + 'comercio/usuario/' + idUsuario)
				.then(response => 
				{
					commit('setComercio', response.data)
					resolve(response)
				})
				.catch(error => 
				{
					reject(error)
				})
			})
		}

	}
}