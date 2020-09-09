export default function auth({ store, next }) {
    if (!store.getters["auth/check"])
    {
         return next({ name: "login" });
        console.log("guest is if");

    }
    else
    {
        return next();
        console.log("guest is else");

    }
}
