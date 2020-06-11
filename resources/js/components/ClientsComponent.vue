<template>
    <b-container style="padding: 2%;">
        <b-card title="Clientes" class="mb-2">
            <b-container class="bv-example-row" fluid="md">
                <b-row align-h="end">
                    <b-col cols="12" md="4"	lg="2"	xl="2">
                        <b-button block href="#" variant="primary" v-b-modal.modal-prevent-closing style="padding-bottom: 5px;">New Cliente</b-button>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-card-text>
                            <b-container>
                                <b-row align-v="center">
                                    <b-col align-self="center">
                                        <b-table striped hover :items="items" :fields="fields">
                                            <template v-slot:cell(actions)="row">
                                                <b-button variant="outline-warning" @click="handleEdit(row)" class="mb-2">
                                                    <b-icon icon="pencil-square" aria-hidden="true"></b-icon>
                                                </b-button>
                                                <b-button variant="outline-danger" @click="handleDelete(row)" class="mb-2">
                                                    <b-icon icon="trash" aria-hidden="true"></b-icon>
                                                </b-button>
                                            </template>
                                        </b-table>
                                    </b-col>
                                </b-row>
                            </b-container>
                        </b-card-text>
                    </b-col>
                </b-row>
            </b-container>
        </b-card>

        <!-- Modal Edit -->
        <b-modal :id="infoModal.id" :title="infoModal.title" @hidden="resetModal" @ok="handleOk">
            <form id="modal-edit" ref="formEdit" @submit.stop.prevent="handleSubmit">
                <b-container>
                    <b-row>
                        <input type="hidden" ref="type_form" value="true">
                        <b-col cols="12" md="6">
                            <b-form-group :state="editnameState" label="Nombre" label-for="editname" invalid-feedback="El nombre es requerido" >
                                <b-form-input class="sr-only" id="editid" v-model="editid" required ></b-form-input>
                                <b-form-input id="editname" v-model="editname" :state="editnameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="editlastNameState" label="Apellido" label-for="editlastname" invalid-feedback="El apellido es requerido" >
                                <b-form-input id="editlastname" v-model="editlastname" :state="editlastNameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="editageState" label="Edad" label-for="editage" invalid-feedback="La edad es requerida" >
                                <b-form-input id="editage" v-model="editage" :state="editageState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="editconcessionarieState" label="Concesionario" label-for="editconcessionarie" invalid-feedback="El concesionario es requerido" >
                                <b-form-select id="editconcessionarie" v-model="editconcessionarieselected" :options="editoptions" :state="editconcessionarieState" required></b-form-select>
                            </b-form-group>
                        </b-col>
                    </b-row>
                </b-container>
            </form>
        </b-modal>

        <b-modal id="modal-prevent-closing" ref="modal" title="Nuevo cliente" size="lg" @show="resetModal" @hidden="resetModal" @ok="handleOk">
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-container>
                    <b-row>
                        <input type="hidden" ref="type_form" value="false">
                        <b-col cols="12" md="6">
                            <b-form-group :state="nameState" label="Nombre" label-for="name" invalid-feedback="El nombre es requerido" >
                                <b-form-input id="name" v-model="name" :state="nameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="lastNameState" label="Apellido" label-for="lastname" invalid-feedback="El apellido es requerido" >
                                <b-form-input id="lastname" v-model="lastname" :state="lastNameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="ageState" label="Edad" label-for="age" invalid-feedback="La edad es requerida" >
                                <b-form-input id="age" v-model="age" :state="ageState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="concessionarieState" label="Concesionario" label-for="concessionarie" invalid-feedback="El concesionario es requerido" >
                                <b-form-select id="concessionarie" v-model="concessionarieselected" :options="options" :state="concessionarieState" required></b-form-select>
                            </b-form-group>
                        </b-col>
                    </b-row>
                </b-container>
            </form>
        </b-modal>
    </b-container>
</template>

<script>
  export default {
    data() {
      return {
        name: '',
        nameState: null,
        lastname: '',
        lastNameState: null,
        age: '',
        ageState: null,
        concessionarieselected: null,
        concessionarieState: null,
        options: [
            { value: null, text: 'Seleccione una opcion' },
        ],
        
        editid: '',
        editname: '',
        editnameState: null,
        editlastname: '',
        editlastNameState: null,
        editage: '',
        editageState: null,
        editconcessionarieselected: null,
        editconcessionarieState: null,
        editoptions: [
            { value: null, text: 'Seleccione una opcion' },
        ],

        fields: [
            { key: 'name', label: 'Nombre' },
            { key: 'lastname', label: 'Apellido' },
            { key: 'age', label: 'Edad' },
            { key: 'concessionaire.name', label: 'Concesionario' },
            { key: 'actions', label: 'Acciones' },
        ],
        items: [],
        
        infoModal: {
            id: 'info-modal',
            title: '',
            content: ''
        }
      }
    },
    created() {
        this.axios
            .get('https://crudautomotriz.000webhostapp.com/api/clients')
            .then(response => {
                this.items = response.data;
            });
        this.axios
            .get('https://crudautomotriz.000webhostapp.com/api/concessionaires')
            .then(response => {
                response.data.forEach(element => {
                    this.options.push({ value: element.id, text: element.name});
                    this.editoptions.push({ value: element.id, text: element.name});
                });
            });
    },
    methods: {
        checkFormValidity() {
            if (this.$refs.type_form.value == 'true') {
                const valid = this.$refs.formEdit.checkValidity()
                this.editnameState = (this.editname != '')
                this.editlastNameState = (this.editlastname != '')
                this.editageState = (this.editage != '')
                this.editconcessionarieState = (this.editconcessionarieselected != null)
                return valid
            } else {
                const valid = this.$refs.form.checkValidity()
                this.nameState = (this.name != '')
                this.lastNameState = (this.lastname != '')
                this.ageState = (this.age != '')
                this.concessionarieState = (this.concessionarieselected != null)
                return valid
            }
        },
        resetModal() {
            this.name = ''
            this.nameState = null
            this.lastname = ''
            this.lastNameState = null
            this.age = ''
            this.ageState = null
            this.concessionarieselected = null
            this.concessionarieState = null

            this.editid = ''
            this.editname = ''
            this.editnameState = null
            this.editlastname = ''
            this.editlastNameState = null
            this.editage = ''
            this.editageState = null
            this.editconcessionarieselected = null
            this.editconcessionarieState = null
        },
        handleOk(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault()
            // Trigger submit handler
            this.handleSubmit()
        },
        handleSubmit() {
            // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
                return
            }
            if (this.$refs.type_form.value == 'true') {
                let editItem = {
                    id: this.editid,
                    name: this.editname,
                    lastname: this.editlastname,
                    age: this.editage,
                    concessionaire_id: this.editconcessionarieselected,
                };

                this.axios
                .put('https://crudautomotriz.000webhostapp.com/api/clients/'+this.editid, editItem)
                .then(response => {
                    this.$set(this.items, this.infoModal.content.index, response.data.client)
                });

                // Hide the modal manually
                this.$nextTick(() => {
                    // this.$bvModal.hide('modal-edit')
                    this.$root.$emit('bv::hide::modal', this.infoModal.id)
                })
            
            } else {
                let newItem = {
                    name: this.name,
                    lastname: this.lastname,
                    age: this.age,
                    concessionaire_id: this.concessionarieselected,
                };
                this.axios
                .post('https://crudautomotriz.000webhostapp.com/api/clients', newItem)
                .then(response => {
                    this.items.splice(0,0,response.data.client);
                });

                // Hide the modal manually
                this.$nextTick(() => {
                    this.$bvModal.hide('modal-prevent-closing')
                })
            }

        },
        handleEdit(row) {
            this.infoModal.title = `Cliente: ${row.item.name} ${row.item.lastname}`
            this.infoModal.content = row
            this.editid = row.item.id
            this.editname = row.item.name
            this.editlastname = row.item.lastname
            this.editage = row.item.age
            this.editconcessionarieselected = row.item.concessionaire_id
            this.$root.$emit('bv::show::modal', this.infoModal.id)
        },
        handleDelete(row) {
            this.$bvModal.msgBoxConfirm('Desea eliminar este cliente?')
                .then(value => {
                    if (value == true) {
                        this.axios
                            .delete('https://crudautomotriz.000webhostapp.com/api/clients/'+row.item.id)
                            .then(response => {
                                this.items.splice(row.index, 1);
                            });
                    }
                })
                .catch(err => {
                // An error occurred
                })
        },
    }
  }
</script>