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
    <div class="form-group col-lg-12 col-md-12 col-sm-12 mb-2">
      <input
        type="number"
        v-model="headcount"
        class="form-control"
        id="chaircode"
        placeholder="Please insert the headcount"
      />
      <button
        type="button"
        class="btn btn-warning btn-sm ripple m-1"
        style="padding:12px 20px;"
        @click="submitForm"
      >Submit</button>
    </div>
    <ul>
     <li v-if="headcount!=0 && headcount>4">2 tables required, head to Table T1 and T3</li>
    </ul>
  </div>
</template>


<script>
export default {
  data() {
    return {
      csrf: document.head.querySelector('meta[name="csrf-token"]').content,
      id: "",
      baseUrl: "",
      data: [],
      headcount: "",
      available:{}
    };
  },

  methods: {
    submitForm() {
      let url = this.baseUrl + "/checkavailable";
      this.axios
        .get(url)
        .then(async res => {
          let data = res.data.data;
          this.available = data;
        })
        .catch(e => {
          this.errors.push(e.data);
        });
    }
  },
  mounted() {
    this.baseUrl = window.baseUrl;
  }
};
</script>
</script>