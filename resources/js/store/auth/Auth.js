export default
{
	state(){
		return{
            token:  null,
            user:   null,
            logged: false
		}
	},

	getters:
	{
		iduser:   state => state.iduser,
		username: state => state.username,
		getUser:  state => state.user,
		getAuth:  state => state.auth,
	},

	mutations:
	{
		setUser (state, user)
        {
			state.user 	   = user
			state.iduser   = user.id_usuario
			state.username = user.nb_usuario
		},
		
		setAuth (state, auth)
        {
            state.auth 	= auth
		},
		
		setIdUsuario(state, iduser)
		{
			state.iduser  = iduser
		},

		setNbUsuario(state, username)
		{
			state.username = username
		},
    },
    
    actions:
    {
        login( { commit }, credentials )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'login', credentials)
				.then(response => 
				{
					//context.commit(mutations.LOGGED, true)
					resolve(response)
				})
				.catch(error => 
				{
					reject(error)
				})
			})
        },
        
        register( { commit }, form )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'register', form)
				.then(response => 
				{
					resolve(response)
				})
				.catch(error => 
				{
					reject(error)
				})
			})
        },
        
        logout( { commit }, categoria )
		{
			axios.post('/api/' + 'comercio/categoria/' + categoria)
			.then( response =>
			{
				commit('setComercios', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
        },
        
        rememberPassword( { commit }, email )
		{
			axios.post('/api/' + 'comercio/categoria/' + categoria)
			.then( response =>
			{
				commit('setComercios', response.data)
			})
            .catch( error =>
            {
              console.log(error)
            })
        },
        
        resetPassword( { commit }, user )
		{
			axios.get('/api/' + 'comercio/categoria/' + categoria)
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
