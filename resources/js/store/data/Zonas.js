export default
{
	state(){
		return	{
			zonas: [ ],
		}
	},

	getters:
	{
		getZonas: state => state.zonas,
	},

	mutations:
	{
		setZonas (state, zonas)
        {
            state.zonas 	= zonas
		},

		delZonas (state, Zonas)
        {
            state.zonas 	= zonas
		},

		insZonas(state, zonas)
        {
            state.zonas 	= zonas
		},
	},

	actions:
	{

		apiZonas( { commit } )
		{
			axios.get('/api/v1/' + 'zona')
			.then( response =>
			{
				commit('setZonas', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
		}

	}
}