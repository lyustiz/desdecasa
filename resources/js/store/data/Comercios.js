export default
{
	state(){
		return	{
			comercios: [ ],
		}
	},

	getters:
	{
        getComercios: state => state.comercios,
                
        countComercios: state => state.comercios.length,
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
	},

	actions:
	{

		apiComerciosCategoria( { commit }, categoria )
		{
            console.log(categoria);
			axios.get('/api/v1/' + 'comercio/categoria/' + categoria)
			.then( response =>
			{
				commit('setComercios', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		}

	}
}