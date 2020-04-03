export default
{
	state(){
		return	{
			categorias: [
                { id: 1 , nb_categoria: 'Ropa', icon: 'mdi-tshirt-crew' , src: require('~/assets/img/categorias/ropa.jpg') },
                { id: 2 , nb_categoria: 'Calzado', icon: 'mdi-shoe-formal' , src: require('~/assets/img/categorias/calzado.jpg') },
                { id: 3 , nb_categoria: 'Comida', icon: 'mdi-food' , src: require('~/assets/img/categorias/comida.jpg') },
                { id: 4 , nb_categoria: 'Belleza', icon: 'mdi-hair-dryer' , src: require('~/assets/img/categorias/belleza.jpg') },
                { id: 5 , nb_categoria: 'Mercado', icon: 'mdi-cart' , src: require('~/assets/img/categorias/mercado.jpg') },
                { id: 6 , nb_categoria: 'Mensajeria', icon: 'mdi-motorbike' , src: require('~/assets/img/categorias/mensajeria.jpg') },
                { id: 7 , nb_categoria: 'Drogueria', icon: 'mdi-needle' , src: require('~/assets/img/categorias/drogueria.jpg') },
                { id: 8 , nb_categoria: 'Ferreteria', icon: 'mdi-hammer-screwdriver' , src: require('~/assets/img/categorias/ferreteria.jpg') }
            ],
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
		

	}
}
