import AppFormat  from './AppFormat';
import AppRules   from './AppRules'
import AppMessage from './AppMessage'

export default 
{
    mixins: [AppFormat, AppRules, AppMessage],

    data() 
    {
        return {
            idUser:     this.$store.getters.idUser,
            valid:      true,
            calendar:   false,
            dates:      {},
            picker:     false,
            loading:    true,
            item:       null
        }
    },

    created()
    {
        //this.fillSelects()
       // this.mapForm();
    },

	computed: 
	{
        fullUrl() 
		{
            return this.$App.baseUrl + 'v1/' + this.resource;
        },
		
        fullUrlId() 
		{
            return this.fullUrl + '/' + this.item['id']
        },
    },

    methods: 
	{
        mapForm()
        {
            if(this.item)
            {
                for(var key in this.item)
                {
                    if(this.form.hasOwnProperty(key))
                    {
                        if(key.includes('fe_') && this.item[key].length > 10)
                        {
                            this.dates[key] =  this.formatDate(this.item[key]);
							
							this.form[key] = this.item[key].substr(0, 10);
							
                        } else {
							
							this.form[key]  =  this.item[key];
						}
                    }
                }
            }else
            {
               this.clear()
            }
        },

        fetch()
        {

        },

		store() 
		{
            if (!this.$refs.form.validate())  return 
			
            this.loading = true;
				
            axios.post(this.fullUrl, this.form)
            .then(response => 
            {
                this.validResponse(response)
            })
            .catch(error => 
            {
                this.showError(error);
            })
            .finally( () =>
            {
                this.loading = false;
            });
        },
		
        update() 
		{
            if (!this.$refs.form.validate())  return 

            this.loading = true;
            this.form.id_usuario = 0;
            
            axios.put(this.fullUrlId, this.form)
            .then(response => 
            {
                this.validResponse(response)
            })
            .catch(error =>
            {
                this.showError(error);
            })
            .finally( () =>
            {
                this.loading = false
            }); 
        },
        
        reset()
        {

            for(var key in this.dates)
            {
                this.dates[key] = '';
            }
            
            if(this.$refs.form)
            {
                this.$refs.form.reset();
            }
            
            this.mapForm();

            this.form.id_usuario = this.idUser
        },
		
        clear()
        {
            for(var key in this.dates)
            {
                this.dates[key] = '';
            }

            for(var key in this.form)
            {
                this.form[key] = '';
            }

            this.$refs.form.resetValidation();

            this.form.id_usuario = this.idUser
        },
    }
}
