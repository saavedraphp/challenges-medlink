const { createApp } = Vue

createApp({
    data() {
        return {
            user_id: null,
            name: '',
            last_name: '',
            age: '',
            users: [],
            errors: [],
            accion: ''
        }
    },

    methods: {
        add_user: function () {
            this.errors = []
            //validacion de los campos
            if (!this.name)
                this.errors.push('The Name is required');


            if (!this.last_name)
                this.errors.push('The Last Name is required');

            if (!this.age)
                this.errors.push('The Age is required');

            if (parseInt(this.age) <= 0)
                this.errors.push('The value has to be numeric');


            // si entro en alguna validacion corta el proceso
            if (this.errors.length > 0)
                return false;


                //almacenar registro en array(users) vue
            if (this.accion == 'save') {
                this.users.push({
                    name: this.name,
                    last_name: this.last_name,
                    age: this.age,
                    created_at: new Date().toLocaleString('sv-SE'),
                })
            }
            else {
                this.users[this.user_id].name = this.name;
                this.users[this.user_id].last_name = this.last_name;
                this.users[this.user_id].age = this.age;
            }
            this.save_storage();


            document.getElementById('close').click();
            console.log(this.users);

        },


        //elimina usuario (index)
        delete_user: function (index) {
            if (confirm("Are you sure you want to delete the record?: " + index))
                this.users.splice(index, 1);
            this.save_storage();

        },

        //Carga el modal y renicia objetos
        showModal: function () {
            this.resetModal();
            this.accion = 'save';
            document.getElementById('exampleModalLabel').innerText = "New User";
        },

        //optione los datos del usuario a modificar
        get_user: function (index) {
            document.getElementById('exampleModalLabel').innerText = "Edit User";
            this.user_id = index;
            this.name = this.users[index].name;
            this.last_name = this.users[index].last_name;
            this.age = this.users[index].age;

            this.accion = "update";
        },


        //reset objetos y variables del modal
        resetModal: function () {
            this.errors = []
            this.user_id = null;
            this.name = '';
            this.last_name = '';
            this.age = '';
            this.accion='';
        },


        // actualiza la variable DbStorage en localStorage
        save_storage: function () {
            localStorage.setItem('DbStorage', JSON.stringify(this.users));
        }



    },// find methods

    //busca si existe la DbStorage en localStorage si no existe inicializa la variable users.
    created: function () {
        let datos = JSON.parse(localStorage.getItem('DbStorage'));

        if (datos === null)
            this.users = [];
        else
            this.users = datos;

    },




}).mount('#app')