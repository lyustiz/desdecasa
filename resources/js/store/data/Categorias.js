export default
{
	state(){
		return	{
			categorias: [ ],
		}
	},

	getters:
	{
		getCategorias: state => state.categorias,

		getCategoriaById: (state) => (id) => {
			return state.categorias.find(categoria => categoria.id === id)
		}
	},

	mutations:
	{
		setCategorias (state, categorias)
        {
            state.categorias 	= categorias
		},

		delCategoria (state, categorias)
        {
            state.categorias 	= categorias
		},

		insCategoria(state, categorias)
        {
            state.categorias 	= categorias
		},
	},

	actions:
	{

		apiCategorias( { commit } )
		{
			axios.get('/api/v1/' + 'categoria')
			.then( response =>
			{
				commit('setCategorias', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		}

	}
}
