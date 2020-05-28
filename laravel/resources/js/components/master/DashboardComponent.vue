<template>
 
      <div class="table-responsive">
        <el-row style="margin-bottom: 15px;">
          <el-col :span="5">
            <el-select
              v-model="filters[0].value"
              placeholder="Type of Bin"
              multiple="multiple"
            >
              <el-option
                v-for="dataset in datasets"
                v-bind:value="dataset.dataset_desc"
                v-bind:key="dataset.id"
                v-if="dataset.datagroup_code==12"
                v-bind:label="dataset.dataset_desc"
              ></el-option>
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select
              v-model="filters[1].value"
              placeholder="Status of Bin"
              multiple="multiple"
            >
              <el-option
                v-for="dataset in datasets"
                v-bind:value="dataset.dataset_desc"
                v-bind:key="dataset.id"
                v-if="dataset.datagroup_code==11"
                v-bind:label="dataset.dataset_desc"
              ></el-option>
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select
              v-model="filters[2].value"
              placeholder="Main Location"
              multiple="multiple"
            >
              <el-option
                v-for="dataset in datasets"
                v-bind:value="dataset.dataset_desc"
                v-bind:key="dataset.id"
                v-if="dataset.datagroup_code==8"
                v-bind:label="dataset.dataset_desc"
              ></el-option>
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select v-model="filters[3].value" placeholder="Main Location" multiple="multiple">
              <el-option
                v-for="college in colleges"
                v-bind:value="college.coll_name"
                v-bind:key="college.id"
                v-bind:label="college.coll_name"
              ></el-option>
            </el-select>
          </el-col>
        </el-row>

        <data-tables
          v-bind:data="data"
          :filters="filters"
          :table-props="tableProps"
          :page-size="5"
          :pagination-props="{ background: true, pageSizes: [5] }"
        >
          <el-table-column type="selection" width="55"></el-table-column>
          <el-table-column
            v-for="column in columns"
            :prop="column.prop"
            :label="column.label"
            :key="column.label"
            sortable="custom"
          ></el-table-column>
        </data-tables>
      </div>
</template>


<script>
import { required } from "vuelidate/lib/validators";
var data, columns;
data = [];
columns = [
  {
    prop: "bin_type",
    label: "Type of Bin"
  },
  {
    prop: "bin_id",
    label: "Code of Bin"
  },
  {
    prop: "bin_status",
    label: "Status of Bin"
  },
  {
    prop: "main_location_type",
    label: "Type of Main Location"
  },
  {
    prop: "main_location_id",
    label: "Main Location"
  }
];
export default {
  data() {
    return {
      baseUrl: "",
      data: [],
      datasets: [],
      colleges: [],
      columns,
      filters: [
        {
          value: "",
          prop: "bin_type"
        },
        {
          value: "",
          prop: "bin_status"
        },
        {
          value: "",
          prop: "main_location_type"
        },
        {
          value: "",
          prop: "main_location_id"
        }
      ],
      tableProps: {
        border: true,
        stripe: true,
        defaultSort: {
          prop: "id",
          order: "descending"
        }
      }
    };
  },
  methods: {
    loadData() {
      this.axios
        .get(this.baseUrl + "/bin-location")
        .then(async res => {
          this.data = res.data.data;
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    },
    loadDataset() {
      this.axios
        .get(this.baseUrl + "/dataset")
        .then(async res => {
          this.datasets = res.data.data;
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    },
    loadColleges() {
      this.axios
        .get(this.baseUrl + "/college")
        .then(async res => {
          this.colleges = res.data.data;
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    },
    handleClick(command) {
      this.$message(`click dropdown button ${command}`);
    }
  },
  mounted() {
    this.baseUrl = window.baseUrl;
    this.loadData();
    this.loadDataset();
    this.loadColleges();
  }
};
</script>