<template>
  <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="ul-widget__head">
          <div class="ul-widget__head-label">
            <h3 class="ul-widget__head-title">Current Log</h3>
          </div>
          <div class="ul-widget__head-toolbar">
            <ul
              class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line"
              role="tablist"
            >
              <li class="nav-item">
                <a
                  class="nav-link active show no-pjax"
                  data-toggle="tab"
                  href="#__g-widget-s6-tab1-content"
                  role="tab"
                  aria-selected="true"
                >Today</a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link no-pjax"
                  data-toggle="tab"
                  href="#__g-widget-s6-tab2-content"
                  role="tab"
                  aria-selected="false"
                >This Month</a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link no-pjax"
                  data-toggle="tab"
                  href="#__g-widget-s6-tab3-content"
                  role="tab"
                  aria-selected="false"
                >This Year</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="ul-widget__body">
          <div class="tab-content">
            <div class="tab-pane active show" id="__g-widget-s6-tab1-content">
              <div class="ul-widget-s6__items">
                <div class="ul-widget-s6__item" v-for="audit in audittrails"  v-if="audit.created_at.slice(0,10)===currentDay">
                
                    <span class="ul-widget-s6__badge">
                      <p
                        class="badge-dot-warning ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='U'"
                      ></p>
                      <p
                        class="badge-dot-success ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='A'"
                      ></p>
                      <p
                        class="badge-dot-danger ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='D'"
                      ></p>
                    </span>
                    <span class="ul-widget-s6__text">{{audit.activity}}</span>
                    <span class="ul-widget-s6__time">{{audit.created_at}}</span>
               
                </div>
              </div>
            </div>

            <div class="tab-pane" id="__g-widget-s6-tab2-content">
              <div class="ul-widget2">
                <div class="ul-widget-s6__items">
                  <div class="ul-widget-s6__item" v-for="audit in audittrails"  v-if="audit.created_at.slice(5,7)===currentMonth">
                     <span class="ul-widget-s6__badge">
                      <p
                        class="badge-dot-warning ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='U'"
                      ></p>
                      <p
                        class="badge-dot-success ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='A'"
                      ></p>
                      <p
                        class="badge-dot-danger ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='D'"
                      ></p>
                    </span>
                    <span class="ul-widget-s6__text">{{audit.activity}}</span>
                    <span class="ul-widget-s6__time">{{audit.created_at}}</span>
                  </div>
                </div>
              </div>
            </div>
                 <div class="tab-pane" id="__g-widget-s6-tab3-content">
              <div class="ul-widget2">
                <div class="ul-widget-s6__items">
                  <div class="ul-widget-s6__item" v-for="audit in audittrails"  v-if="audit.created_at.slice(0,4)===currentYear">
                     <span class="ul-widget-s6__badge">
                      <p
                        class="badge-dot-warning ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='U'"
                      ></p>
                      <p
                        class="badge-dot-success ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='A'"
                      ></p>
                      <p
                        class="badge-dot-danger ul-widget6__dot"
                        v-if="audit.activity.slice(0,1)==='D'"
                      ></p>
                    </span>
                    <span class="ul-widget-s6__text">{{audit.activity}}</span>
                    <span class="ul-widget-s6__time">{{audit.created_at}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      baseUrl: "",
      audittrails: [],
      currentDay: "",
      currentMonth:"",
      currentYear:""
    };
  },
  mounted() {
    this.baseUrl = window.baseUrl;
    this.axios
      .get(this.baseUrl + "/audittrail")
      .then(async res => {
        this.audittrails = res.data.data;
        this.currentDay = new Date()
          .toJSON()
          .slice(0, 10)
          .replace(/-/g, "-");
        this.currentMonth = new Date()
          .toJSON()
          .slice(5, 7);
          this.currentYear = new Date()
          .toJSON()
          .slice(0, 4);
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>