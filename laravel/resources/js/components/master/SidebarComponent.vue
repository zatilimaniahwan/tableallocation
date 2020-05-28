<!--
---------------------------------------------------------
| *** Developed by Nurzatilimani binti Muhamad Ahwan     |
| *** Last Update: 17/12/2019                            |
---------------------------------------------------------
-->
<template>
  <div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
      <ul class="navigation-left">
        <li v-bind:class="[cssClass,( currentUrl===baseUrl+ '/home') ? activeClass : '']" data-item>
          <a class="nav-item-hold no-pjax" :href="baseUrl+'/home'">
            <i class="nav-icon i-Home1"></i>
            <span class="nav-text">Dashboard</span>
          </a>
          <div class="triangle"></div>
        </li>
        <li
          v-bind:class="[cssClass,( currentUrl===baseUrl+ '/tables') ? activeClass : '']"
          data-item
        >
          <a class="nav-item-hold no-pjax" :href="baseUrl+'/tables'">
            <i class="nav-icon i-Big-Data"></i>
            <span class="nav-text">Table</span>
          </a>
          <div class="triangle"></div>
        </li>
            <li
          v-bind:class="[cssClass,( currentUrl===baseUrl+ '/checkavailables') ? activeClass : '']"
          data-item
        >
          <a class="nav-item-hold no-pjax" :href="baseUrl+'/checkavailables'">
            <i class="nav-icon  i-File-Clipboard"></i>
            <span class="nav-text">Table Available</span>
          </a>
          <div class="triangle"></div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      cssClass: "nav-item",
      activeClass: "active",
      baseUrl: ""
    };
  },
  computed: {
    currentUrl() {
      return window.location.pathname;
    }
  },
  mounted() {
    this.baseUrl = window.baseUrl;
  }
};
</script>
