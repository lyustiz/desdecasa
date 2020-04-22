export default
{
	state(){
		return	{

			comercio: null,

			comercios: [],

			comercioById: null
		}
	},

	getters:
	{
        getComercios: state => state.comercios,
                
		countComercios: state => state.comercios.length,
		
		getComercio: state => state.comercio,

		getComercioById: state => state.comercioById,
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
		
		setComerciobyId (state, comercio)
        {
            state.comercioById 	= comercio
		},
	},

	actions:
	{

		apiComerciosCategoria( { commit }, categoria )
		{
			if(!categoria)
			{
				commit('setComercios', [])
				return
			}

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
		},

		apiComerciosNombre( { commit }, barrio )
		{
			if(!barrio)
			{
				commit('setComercios', [])
				return
			}

			axios.get('/api/v1/' + 'comercio/barrio/' + barrio)
			.then( response =>
			{
				commit('setComercios', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		},

		apiComercioById( { commit }, comercioId )
		{
			if(!comercioId)
			{
				commit('setComerciobyId', null)
				return
			}

			axios.get('/api/v1/' + 'comercio/' + comercioId)
			.then( response =>
			{
				commit('setComerciobyId', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		},

	}
}