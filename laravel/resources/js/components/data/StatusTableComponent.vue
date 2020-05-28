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
        <br />
        <div class="rowSearch">
          <el-col :span="24">
            <el-input v-model="filters[0].value" placeholder="Search"></el-input>
          </el-col>
        </div>
        <br />
        <br />
        <br />
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
                   <input type="hidden" v-model="statustable.table_id" />
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label for="chaircode" class="custom-form-label">Table Code:</label>
                  <input
                    type="text"
                    v-model="statustable.table_code"
                    class="form-control"
                    id="chaircode"
                    placeholder="Please insert the code"
                    disabled
                  />
                  <small class="errorText" v-if="!$v.statustable.table_code.required">This field is required</small>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label for="chairdesc" class="custom-form-label">Chair Code:</label>
                  <input
                    type="text"
                    v-model="statustable.chair_code"
                    class="form-control"
                    id="chairdesc"
                    placeholder="Please insert the description "
                    disabled
                  />
                  <small class="errorText" v-if="!$v.statustable.chair_code.required">This field is required</small>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
                  <label for="chairdesc" class="custom-form-label">Chair Code:</label>
                  <select class="form-control" v-model="statustable.status">
                    <option v-for="type in types" v-bind:value="type.key">{{ type.value }}</option>
                  </select>
                  <small class="errorText" v-if="!$v.statustable.status.required">This field is required</small>
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
    prop: "table_code",
    label: "Table Code"
  },
  {
    prop: "chair_code",
    label: "Chair Code"
  },
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
          }
        ]
      },
      filters: [
        {
          prop: ["table_code", "chair_code"],
          value: ""
        }
      ],
      tableProps: {
        border: true,
        stripe: true,
        defaultSort: {
          prop: "id",
          order: "ascending"
        }
      },
      isModalVisible: false,
      isCreate: false,
      isEdit: false,
      title: "",
      statustable: {},
      params: {
        activity: ""
      },
      types: [
        {"key":0,"value":"Unoccupied"},
        {"key":1,"value":"Occupied"},
      ]
    };
  },
  validations: {
    statustable: {
     table_code: {  required},
      chair_code: { required },
      status:{required}
    }
  },
  methods: {
    loadData() {
      this.axios
        .get(this.baseUrl + "/statustable")
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
      let url = this.baseUrl + "/statustable/" + id + "/edit";
      this.axios
        .get(url)
        .then(async res => {
          let data = res.data.data;
          this.statustable = data;
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
      this.statustable.table_code = "";
      this.statustable.chair_code = "";
       this.statustable.status = "";
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
          let url = this.baseUrl + "/statustable/" + this.id;
          this.axios
            .patch(url, this.statustable)
            .then(response => {
              this.params.activity = "Update Status Table Data";
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