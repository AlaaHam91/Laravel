<template>
  <div
    class="container border rounded-lg w-3/4 mt-12 border-gray-300 p-6 mx-auto flex content-center font-sans shadow-2xl"
  >
    <div class="w-2/5">
      <img class="w-full mx-auto" :src="imgForm" alt="image_for_logout" />
    </div>

    <div class="text-center w-3/5 self-center">
      <div v-if="isLoggedIn">
        <a
          id="logout-link"
          href="#"
          @click.prevent="logout"
          v-show="show"
          class="mt-8 border-none rounded-full bg-mainColor px-16 py-2 text-white"
          >Logout</a
        >
        <h1 class="text-3xl text-gray-700">{{ result }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      result: "",
      imgForm: "/images/log-out.svg",
      show: true
    };
  },
  methods: {
    logout() {
      const { data } = axios
        .post("api/v1/auth/logout")
        .then(({ data }) => {
          this.$store.commit("auth/LOGOUT");
          this.result = data.msg;
          this.show = false;
          this.$router.push('/login');
        })
        .catch(error => {
          this.result = error.response.data;
        });
    }
  },
  computed: {
    ...mapGetters({
      isLoggedIn: "auth/check"
    })
  }
};
</script>
