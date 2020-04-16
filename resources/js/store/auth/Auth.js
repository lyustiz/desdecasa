export default
{
	state(){
		return{
			token:  	null,
			expire:     null,
			auth: 		false,
			user: 		null,
			userid: 	null,
			username: 	null,
		}
	},

	getters:
	{
		getToken:   	state => state.token,
		getExpire:   	state => state.expire,
		getAuth: 		state => state.auth,
		getUser:  		state => state.user,
		getUserid:  	state => state.userid,
		getUsername:  	state => state.username,
	},

	mutations:
	{
		setToken (state, token)
        {
			state.token		= token
		},

		setExpire (state, expire)
		{
			state.expire 	= expire
		},
		
		setAuth (state, auth)
        {
            state.auth 		= auth
		},
		
		setUser(state, user)
		{
			state.user  	= user
			state.userid   	= user.id
			state.username 	= user.nb_usuario
		},

		setUserid(state, userid)
		{
			state.userid 	= userid
		},

		setUsername(state, username)
		{
			state.username = username
		},
    },
    
    actions:
    {
        login( { dispatch }, credentials )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'login', credentials)
				.then(response => 
				{
					if (response.status == 200)
					{
						const 	data = {
									user: response.data.user,
									token: response.data.auth,
									expire: response.data.expires_in
								};
						
						localStorage.setItem("token", 	response.data.auth)
						localStorage.setItem("user", 	JSON.stringify(response.data.user))
						localStorage.setItem("expire", 	response.data.expires_in)
						localStorage.setItem("auth", 	true)

						dispatch('autenticate', data)
						resolve( { status: 200 } )
					}
					else{

						dispatch('unatenticate')
						reject(response)
					}
					
				})
				.catch(error => 
				{
					dispatch('unatenticate')
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
		
		registerCommerce( { commit }, form )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'register-commerce', form)
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
		
		verify( { commit }, form )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'verify', form)
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
		
		resendEmail( { commit }, form )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'email/resend', form)
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
        
        logout( { dispatch }, categoria )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'logout')
				.then(response => 
				{
					resolve(response)
				})
				.catch(error => 
				{
					reject(error)
				})
				.then()
				{
					dispatch('unatenticate')
				}
			})
        },
        
        recoverPassword( { commit }, form )
		{
			return new Promise((resolve, reject) => 
			{
				axios.post('/api/' + 'recover/password', form)
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
        
        resetPassword( { commit }, form )
		{
			axios.get('/api/' + 'reset/password' + form)
			.then( response =>
			{
				resolve(response)
			})
            .catch( error =>
            {
				reject(error)
            })
		},

		autenticate({ commit }, data)
		{
			commit('setUser'  , data.user);
			commit('setAuth'  , true);
			commit('setToken' , data.token);
			commit('setExpire', data.expire);

		},

		unatenticate({ commit })
		{
			commit('setUser'  , { id: null, nb_usuario: null });
			commit('setAuth'  , false);
			commit('setToken' , null);
			commit('setExpire', null);
		}

    }
}