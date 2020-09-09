<template>
  <div
    class="container border rounded-lg w-3/4 mt-12 border-gray-300 p-6 mx-auto flex content-center font-sans shadow-2xl"
  >
    <div class="w-2/5">
      <img class="w-full mx-auto" :src="imgForm" alt="image_for_login" />
    </div>
    <div class="text-center w-3/5 self-center">
      <h1 class="text-5xl font-bold text-mainColor">Algorum</h1>
      <div class="mt-2">
        <h3 class="text-3xl text-gray-700">welcome !</h3>
        <p class="pb-8 text-gray-600">
          Sign in by entering your information.
        </p>
        <div
          v-if="authError"
          class="text-white mb-4 bg-red-400 p-4 w-1/2 mx-auto"
        >
          <p>{{ authError }}</p>
        </div>
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <input
            class="w-1/2 mx-auto border-b p-4 border-gray-400 outline-none block"
            type="email"
            placeholder="Email"
            name="email"
            v-model="form.email"
            :class="{ 'is-invalid': form.errors.has('email') }"
          />
          <errortailwinds :form="form" field="email"></errortailwinds>
          <input
            class="w-1/2 mx-auto border-b border-gray-400 p-4 border-gray-400 outline-none block"
            type="password"
            placeholder="Password"
            name="password"
            v-model="form.password"
            :class="{ 'is-invalid': form.errors.has('password') }"
          />
          <errortailwinds :form="form" field="password"></errortailwinds>
          <button
            class="mt-8 border-none rounded-full bg-mainColor px-16 py-2 text-white"
            type="submit"
          >
            <clip-loader
              :loading="isLoading"
              color="#fff"
              size="30px"
            ></clip-loader>
            <span v-if="!isLoading">sign in</span>
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </button>
        </form>
        <div>
          <a
            href="/login/github"
            class="mt-8 border-none rounded-full bg-gray-700 px-6 py-2 text-white"
            type="submit"
            >With Github <i class="fa fa-github" aria-hidden="true"></i
          ></a>
          <a
            href="/login/facebook"
            class="mt-8 border-none rounded-full bg-blue-700 px-6 py-2 text-white"
            type="submit"
            >With Facebook
            <i class="fa fa-facebook-square" aria-hidden="true"></i
          ></a>
        </div>
        <p class="pt-4 text-gray-600">
          Not registred?
          <a class="text-mainColor font-bold underline" href="/register"
            >Create an account</a
          >
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { Form } from "vform";
import HasErrorTailwind from "../../components/haserrortailwinds";
import { mapGetters } from "vuex";
import { ClipLoader } from "vue-spinner/dist/vue-spinner.min.js";

Vue.component(HasErrorTailwind.name, HasErrorTailwind);
Vue.component("clip-loader", ClipLoader);

export default {
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
        remember: false
      }),
      imgForm: "/images/login.svg"
    };
  },

  methods: {
    //    async login(){
    //       //  const result=await this.form.post("/api/v1/auth/login")

    //       //it will return object jeson from the method login and to get the data only
    //          const {data}=await this.form.post("/api/v1/auth/login")
    //          //we get the data only from the result of call (login then respondWithToken)
    //          this.$store.dispatch('auth/saveToken',
    //          {
    //             token:data.access_token,
    //             remember:this.remember
    //          })
    //          await this.$store.dispatch('/auth/ftechUser')
    //          //redirect
    //         this.$router.push({'name':'home'})
    //     }

    login() {
      this.$store.dispatch("auth/login");
      this.form
        .post("/api/v1/auth/login")
        .then(({ data }) => {
          this.$store.commit("auth/LOGIN_SUCCESS", {
            token: data.access_token,
            remember: this.remember
          });
          this.$store.dispatch("auth/fetchUser");
          //https://vuejsfeed.com/blog/clean-and-simple-notification-component-for-vue-js
          this.$router.push({ name: "notifications" });
        })
        .catch(error => {
          // console.log(error.response.data);

          this.$store.commit("auth/LOGIN_FAILD", error.response.data);
        });
    }
  },
  computed: {
    ...mapGetters({
      authError: "auth/authError",
      isLoading: "auth/isLoading",
      user: "auth/user"
    })
  }
};
</script>
<style scoped>
.is-invalid {
  border-bottom: 1px solid #e64f5c;
}
</style>
