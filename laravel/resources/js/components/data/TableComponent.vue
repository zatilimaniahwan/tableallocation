<!--
*** Developed by Nurzatilimani binti Muhamad Ahwan ***
** References:
- window.baseUrl is a global variable. Please refer to app.js
- col-lg (big size screen)
- col-md (medium size screen)
- col-sm (small size screen)
- mb (margin bottom)
For more, please refer to Bootstrap 4's documentation!
-->
<template>
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card text-left">
      <div class="card-body">
        <div class="row">
          <button
            type="button"
            @click="showModal"
            class="btn btn-primary btn-sm ripple m-1"
            style="padding:12px 20px;"
          >Add New Data</button>
        </div>
        <br />
        <div class="rowSearch">
          <el-col :span="24">
            <el-input v-model="filters[0].value" placeholder="Search"></el-input>
          </el-col>
        </div>
        <br />
        <br />
        <br />
        <br>
        <div class="table-responsive">
          <data-tables
            v-bind:data="data"
            :action-col="actionCol"
            :filters="filters"
            :table-props="tableProps"
            item-key="data.id"
          >
            <el-table-column
              v-for="column in columns"
              :prop="column.prop"
              :label="column.label"
              :key="column.label"
              sortable="custom"
            ></el-table-column>
          </data-tables>
        </div>
        <p v-for="d in data">{{d.max_number_table}} available, each table {{d.max_number_chair}} chairs.</p>
      </div>
    </div>
    <transition v-if="isModalVisible" name="modal-fade">
      <div class="modal-backdrop">
        <div
          class="modal"
          id="ugModal"
          aria-labelledby="modalTitle"
          aria-describedby="modalDescription"
        >
          <form @submit.prevent="submitForm" v-if="isCreate">
            <header class="modal-header" id="modalTitle">
              <slot name="header">
                <br />
                <h4>{{title}}</h4>
                <button type="button" class="close" @click="closeModal" aria-label="Close modal">x</button>
              </slot>
            </header>
            <section class="modal-body" id="modalDescription">
              <slot name="body">
                <input type="hidden" name="_token" :value="csrf" />
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label  class="custom-form-label">Maximum Number of Table:</label>
                  <input
                    type="number"
                    v-model="table.max_number_table"
                    class="form-control"
                    placeholder="Please insert the max number for the table"
                  />
                  <small class="errorText" v-if="!$v.table.max_number_table.required">This field is required</small>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label class="custom-form-label">Maximum Number of Chair</label>
                 <input
                    type="number"
                    v-model="table.max_number_chair"
                    class="form-control"
                    placeholder="Please insert the max number for the table"
                  />
                  <small class="errorText" v-if="!$v.table.max_number_chair.required">This field is required</small>
                </div>
              </slot>
            </section>
            <footer class="modal-footer">
              <slot name="footer">
                <button
                  type="button"
                  class="btn btn-danger btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  @click="closeModal"
                  aria-label="Close modal"
                >Cancel</button>
                <button
                  type="button"
                  class="btn btn-warning btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  @click="resetForm"
                >Reset</button>
                <input
                  type="submit"
                  class="btn btn-success btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  value="Save"
                />
              </slot>
            </footer>
          </form>
          <!-- Update Form -->
          <form @submit.prevent="updateForm" v-if="isEdit" method="POST">
            <input type="hidden" name="_method" value="PATCH" />
            <header class="modal-header" id="modalTitle">
              <slot name="header">
                <br />
                <h4>{{title}}</h4>
                <button type="button" class="close" @click="closeModal" aria-label="Close modal">x</button>
              </slot>
            </header>
            <section class="modal-body" id="modalDescription">
              <slot name="body">
                <input type="hidden" name="_token" :value="csrf" />
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label  class="custom-form-label">Maximum Number of Table:</label>
                  <input
                    type="number"
                    v-model="table.max_number_table"
                    class="form-control"
                    placeholder="Please insert the max number for the table"
                  />
                  <small class="errorText" v-if="!$v.table.max_number_table.required">This field is required</small>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label class="custom-form-label">Maximum Number of Chair</label>
                 <input
                    type="number"
                    v-model="table.max_number_chair"
                    class="form-control"
                    placeholder="Please insert the max number for the table"
                  />
                  <small class="errorText" v-if="!$v.table.max_number_chair.required">This field is required</small>
                </div>
              </slot>
            </section>
            <footer class="modal-footer">
              <slot name="footer">
                <button
                  type="button"
                  class="btn btn-danger btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  @click="closeModal"
                  aria-label="Close modal"
                >Cancel</button>
                <button
                  type="button"
                  class="btn btn-warning btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  @click="resetForm"
                >Reset</button>
                <input
                  type="submit"
                  class="btn btn-success btn-sm ripple m-1"
                  style="padding:12px 20px;"
                  value="Update"
                />
              </slot>
            </footer>
          </form>
        </div>
      </div>
    </transition>
  </div>
</template>


<script>
import { required, maxLength, alpha } from "vuelidate/lib/validators";
var data, columns;
data = [];
columns = [
  {
    prop: "max_number_table",
    label: "Maximum Number of Table"
  },
  {
    prop: "max_number_chair",
    label: "Maximum Number of Chair"
  }
];
export default {
  data() {
    return {
      csrf: document.head.querySelector('meta[name="csrf-token"]').content,
      id: "",
      baseUrl: "",
      data: [],
      columns,
      actionCol: {
        props: {
          label: "Actions"
        },
        buttons: [
          {
            props: {
              type: "success"
            },
            handler: row => {
              this.editData(row.id);
              this.id = row.id;
            },
            label: "Update"
          },
          {
            props: {
              type: "danger"
            },
            handler: row => {
              this.$swal({
                title: "Are you sure want to destroy this data?",
                text:
                  "If you continue, the data will be disappeared from the database",
                icon: "warning",
                buttons: ["Back", "Delete"],
                dangerMode: true
              }).then(willSubmit => {
                if (willSubmit) {
                  let url = this.baseUrl + "/table/" + row.id;
                  this.axios
                    .delete(url)
                    .then(response => {
                      this.data.splice(row.id);
                      this.params.activity = "Destroy Table Data";
                      let url = this.baseUrl + "/audittrail";
                      this.axios
                        .post(url, JSON.stringify(this.params.activity))
                        .then(response => {
                          this.$swal({
                            icon: "success",
                            text: "Data is successfully destroyed",
                            buttons: false,
                            timer: 1500
                          });
                          this.loadData();
                        })
                        .catch(error => {
                          console.log(error);
                        });
                    })
                    .catch(error => {
                      this.$swal({
                        icon: "error",
                        text: "Data is unsuccessful to be destroyed",
                        buttons: false,
                        timer: 1500
                      });
                    });
                } else {
                  this.$swal({
                    icon: "info",
                    text: "Your data still safe in database",
                    buttons: false,
                    timer: 1500
                  });
                }
              });
            },
            label: "Delete"
          }
        ]
      },
      filters: [
        {
          prop: ["code", "desc"],
          value: ""
        }
      ],
      tableProps: {
        border: true,
        stripe: true,
        defaultSort: {
          prop: "id",
          order: "descending"
        }
      },
      isModalVisible: false,
      isCreate: false,
      isEdit: false,
      title: "",
      table: {},
      params: {
        activity: ""
      },
      types: []
    };
  },
  validations: {
    table: {
     max_number_table: {
        required
      },
      max_number_chair: { required }
    }
  },
  methods: {
    loadData() {
      this.axios
        .get(this.baseUrl + "/table")
        .then(async res => {
          this.data = res.data.data;
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    },
    showModal() {
      this.title = "Add New Data";
      this.isModalVisible = true;
      this.isCreate = true;
      this.isEdit = false;
    },
    closeModal() {
      this.isModalVisible = false;
      this.resetForm();
    },
    editData(id) {
      let url = this.baseUrl + "/table/" + id + "/edit";
      this.axios
        .get(url)
        .then(async res => {
          let data = res.data.data;
          this.table = data;
          this.editModal();
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    },
    editModal() {
      this.title = "Update Current Data";
      this.isModalVisible = true;
      this.isEdit = true;
      this.isCreate = false;
    },
    resetForm() {
      this.table.max_number_table = "";
      this.table.max_number_chair = "";
    },
    submitForm(e) {
      e.preventDefault();
      this.$swal({
        title: "Are you sure want to save this data?",
        text:
          "If you submit this form means you agree to save the data into the database",
        icon: "warning",
        buttons: ["Back", "Save"],
        warningMode: true
      }).then(willSubmit => {
      if (willSubmit) {
          let url = this.baseUrl + "/table" ;
          this.axios
            .post(url, this.table)
            .then(response => {
             // this.params.activity = "Add Table Data";
              let url = this.baseUrl + "/statustable";
              this.axios
                .post(url)
                .then(response => {
                  this.closeModal();
                  this.$swal({
                    icon: "success",
                    text: "Data is successfully added",
                    buttons: false,
                    timer: 1500
                  });
                  this.loadData();
                })
                .catch(error => {
                  console.log(error);
                });
            })
            .catch(error => {
              this.$swal({
                icon: "error",
                text: "Data is unsuccessful to be added",
                buttons: false,
                timer: 1500
              });
            });
        } else {
          this.$swal({
            icon: "info",
            text: "Form is unsuccessful to be sent",
            buttons: false,
            timer: 1500
          });
        }
      });
    },
    updateForm(e) {
      e.preventDefault();
      this.$swal({
        title: "Are you sure want to update this data? ",
        text:
          "If you submit this form means you agree to update the data into the database",
        icon: "warning",
        buttons: ["Back", "Update"],
        warningMode: true
      }).then(willSubmit => {
        if (willSubmit) {
          let url = this.baseUrl + "/table/" + this.id;
          this.axios
            .patch(url, this.table)
            .then(response => {
              this.params.activity = "Update Table Data";
              let url = this.baseUrl + "/audittrail";
              this.axios
                .post(url, JSON.stringify(this.params.activity))
                .then(response => {
                  this.closeModal();
                  this.$swal({
                    icon: "success",
                    text: "Data is successfully updated",
                    buttons: false,
                    timer: 1500
                  });
                  this.loadData();
                })
                .catch(error => {
                  console.log(error);
                });
            })
            .catch(error => {
              this.$swal({
                icon: "error",
                text: "Data is unsuccessful to be updated",
                buttons: false,
                timer: 1500
              });
            });
        } else {
          this.$swal({
            icon: "info",
            text: "Form is unsuccessful to be sent",
            buttons: false,
            timer: 1500
          });
        }
      });
    }
  },
  mounted() {
    this.baseUrl = window.baseUrl;
    this.loadData();
  }
};
</script>