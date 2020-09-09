<template>
  <div>
    <notification
      :options.sync="options"
      :show.sync="showNotification"
      @close="closeNotification"
    >
    </notification>
    <button @click="notice" class="btn btn-primary">Show info</button>
  </div>
</template>

<script>
import Vue from "vue";
import Notification from "../components/Notification";
import { mapGetters } from "vuex";

export default {
  components: {
    Notification
  },
  data() {
    return {
      showNotification: false,
      options: {
        autoClose: true,
        backgroundColor: "#769FCD",
        barColor: "#415f77",
        countdownBar: true,
        showTime: 5000,
        textColor: "#fff",
        noti: []
      }
    };
  },
  methods: {
    notice() {
      this.options.noti = this.$store.getters["auth/notifications"];
      this.showNotification = true;
    },
    closeNotification() {
      this.showNotification = false;
    }
  },
  mounted() {
    this.$store.dispatch("auth/fetchNotifications");
  }
};
</script>
