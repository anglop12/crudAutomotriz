<template>
    <b-container style="padding: 2%;">
        <b-card title="Concesionarios" class="mb-2">
            <b-container class="bv-example-row" fluid="md">
                <b-row align-h="end">
                    <b-col cols="12" md="4"	lg="3"	xl="3">
                        <b-button block href="#" variant="primary" v-b-modal.modal-prevent-closing style="padding-bottom: 5px;">New Concesionario</b-button>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-card-text>
                            <b-container>
                                <b-row align-v="center">
                                    <b-col align-self="center">
                                        <b-table striped hover :items="items" :fields="fields">
                                            <template v-slot:cell(clients)="row">
                                                <b-button variant="outline-info" @click="$bvModal.show(`modal-scoped${row.item.id}`)" class="mb-2">
                                                    <b-icon icon="person-lines-fill" aria-hidden="true"></b-icon>
                                                </b-button>
                                                <b-modal :id="`modal-scoped${row.item.id}`">
                                                    <template v-slot:modal-header>
                                                        <h5>Clientes</h5>
                                                    </template>

                                                    <b-container v-if="row.item.clients.length != 0">
                                                        <template v-slot:default>
                                                            <template>
                                                                <div>
                                                                    <b-table striped hover :items="row.item.clients" :fields="[{ key: 'name', label: 'Nombre' },{ key: 'lastname', label: 'Apellido' },{ key: 'age', label: 'Edad' },]"></b-table>
                                                                </div>
                                                            </template>
                                                        </template>
                                                    </b-container>
                                                    <b-container v-else>
                                                        Este concesionario no posee clientes!
                                                    </b-container>

                                                    <template v-slot:modal-footer="{ close }">
                                                        <b-button size="sm" variant="success" @click="close()">Salir</b-button>
                                                    </template>
                                                </b-modal>
                                            </template>

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
                            <b-form-group :state="editnameState" label="Concesionario" label-for="editname" invalid-feedback="El concesionario es requerido" >
                                <b-form-input class="sr-only" id="editid" v-model="editid" required ></b-form-input>
                                <b-form-input id="editname" v-model="editname" :state="editnameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="editstateState" label="Estado" label-for="editstate" invalid-feedback="El estado es requerido" >
                                <b-form-select id="editstate" ref="editstate" v-model="editstateselected" :options="editstateoptions" :state="editstateState" required></b-form-select>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="editcityState" label="Ciudad" label-for="editcity" invalid-feedback="La ciudad es requerida" >
                                <b-form-select id="editcity" ref="editcity" v-model="editcityselected" :options="editcityoptions" :state="editcityState" required></b-form-select>
                            </b-form-group>
                        </b-col>
                    </b-row>
                </b-container>
            </form>
        </b-modal>

        <b-modal id="modal-prevent-closing" ref="modal" title="Nuevo concesionario" size="lg" @show="resetModal" @hidden="resetModal" @ok="handleOk">
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-container>
                    <b-row>
                        <input type="hidden" ref="type_form" value="false">
                        <b-col cols="12" md="6">
                            <b-form-group :state="nameState" label="Concesionario" label-for="name" invalid-feedback="El concesionario es requerido" >
                                <b-form-input id="name" v-model="name" :state="nameState" required ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="stateState" label="Estado" label-for="state" invalid-feedback="El estado es requerido" >
                                <b-form-select id="state" ref="state" v-model="stateselected" :options="stateoptions" :state="stateState" required></b-form-select>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group :state="cityState" label="Ciudad" label-for="city" invalid-feedback="La ciudad es requerida" >
                                <b-form-select id="city" ref="city" v-model="cityselected" :options="cityoptions" :state="cityState" required></b-form-select>
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
        stateselected: null,
        stateState: null,
        cityselected: null,
        cityState: null,
        stateoptions: [
            { value: null, text: 'Seleccione una opcion' },
            { value: 'bolivar', text: 'bolivar' },
            { value: 'caracas', text: 'caracas' },
            { value: 'anzuategui', text: 'anzuategui' },
        ],
        cityoptions: [
            { value: null, text: 'Seleccione una opcion' },
            { value: 'guayana', text: 'guayana' },
            { value: 'san felix', text: 'san felix' },
            { value: 'area metropolitana', text: 'area metropolitana' },
            { value: 'barcelona', text: 'barcelona' },
        ],

        editid: '',
        editname: '',
        editnameState: null,
        editstateselected: null,
        editstateState: null,
        editcityselected: null,
        editcityState: null,
        editstateoptions: [
            { value: null, text: 'Seleccione una opcion' },
            { value: 'bolivar', text: 'bolivar' },
            { value: 'caracas', text: 'caracas' },
            { value: 'anzuategui', text: 'anzuategui' },
        ],
        editcityoptions: [
            { value: null, text: 'Seleccione una opcion' },
            { value: 'guayana', text: 'guayana' },
            { value: 'san felix', text: 'san felix' },
            { value: 'area metropolitana', text: 'area metropolitana' },
            { value: 'barcelona', text: 'barcelona' },
        ],


        fields: [
            { key: 'name', label: 'Concesionario' },
            { key: 'state', label: 'Estado' },
            { key: 'city', label: 'Ciudad' },
            { key: 'clients', label: 'Clientes' },
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
            .get('https://crudautomotriz.000webhostapp.com/api/concessionaires')
            .then(response => {
                this.items = response.data;
            });

    },
    methods: {
        checkFormValidity() {
            if (this.$refs.type_form.value == 'true') {
                const valid = this.$refs.formEdit.checkValidity()
                this.editnameState = (this.editname != '')
                this.editstateState = (this.editstateselected != null)
                this.editcityState = (this.editcityselected != null)
                return valid
            } else {
                const valid = this.$refs.form.checkValidity()
                this.nameState = (this.name != '')
                this.stateState = (this.stateselected != null)
                this.cityState = (this.cityselected != null)
                return valid
            }

        },
        resetModal() {
            this.name = ''
            this.nameState = null
            this.stateselected = null
            this.stateState = null
            this.cityselected = null
            this.cityState = null
            
            this.editid = ''
            this.editname = ''
            this.editnameState = null
            this.editstateselected = null
            this.editstateState = null
            this.editcityselected = null
            this.editcityState = null
            
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
            // Push the name to submitted names
            let newItem = {
                name: this.name,
                state: this.stateselected,
                city: this.cityselected,
            };

            if (this.$refs.type_form.value == 'true') {
                let editItem = {
                    id: this.editid,
                    name: this.editname,
                    state: this.editstateselected,
                    city: this.editcityselected,
                };

                this.axios
                .put('https://crudautomotriz.000webhostapp.com/api/concessionaires/'+this.editid, editItem)
                .then(response => {
                    this.$set(this.items, this.infoModal.content.index, response.data.concessionaire)
                });

                // Hide the modal manually
                this.$nextTick(() => {
                    this.$root.$emit('bv::hide::modal', this.infoModal.id)
                })
            
            } else {
                let newItem = {
                    name: this.name,
                    state: this.stateselected,
                    city: this.cityselected,
                };
                this.axios
                .post('https://crudautomotriz.000webhostapp.com/api/concessionaires', newItem)
                .then(response => {
                    this.items.splice(0, 0, response.data.concessionaire);
                });

                // Hide the modal manually
                this.$nextTick(() => {
                    this.$bvModal.hide('modal-prevent-closing')
                })
            }
        },
        handleEdit(row) {
            this.infoModal.title = `Concesionario: ${row.item.name}`
            this.infoModal.content = row
            this.editid = row.item.id
            this.editname = row.item.name
            this.editstateselected = row.item.state
            this.editcityselected = row.item.city
            this.$root.$emit('bv::show::modal', this.infoModal.id)
        },
        handleDelete(row) {
            if (row.item.clients.length != 0) {
                this.$bvModal.msgBoxOk('No se puede eliminar, este concesionario posee clientes.')
                    .then(value => {})
                    .catch(err => {})
            } else {
                this.$bvModal.msgBoxConfirm('Desea eliminar este cliente?')
                    .then(value => {
                        if (value == true) {
                            this.axios
                                .delete('https://crudautomotriz.000webhostapp.com/api/concessionaires/'+row.item.id)
                                .then(response => {
                                    this.items.splice(row.index, 1);
                                });
                        }
                    })
                    .catch(err => {
                    // An error occurred
                    })
            }
        },
    }
  }
</script>