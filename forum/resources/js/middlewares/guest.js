//naviguation guards in vue router
export default function guest({ next, store }) {
    if (store.getters["auth/token"]) {
     //  console.log("guest is if");
        return next({ name: "home" });
    } else {
    //  console.log("guest is else");

      return next();
    };
}
