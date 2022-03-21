// 1 cosa da fare importare vue
import Vue from "vue";
// importo vue router plugin di vue
import VueRouter from "vue-router";
// import componente Home
import Home from "./pages/Home.vue";
// importo contatti
import Contacts from "./pages/Contacts.vue";
// importo lo show
import Show from "./pages/posts/Show.vue";
// importo Errore
import Errore from "./pages/Errore.vue";
// diciamo a vue di utilizzare il plugin
Vue.use(VueRouter);
// questo oggetto conterrà tutte le configurazioni di vue router
const router = new VueRouter({
    // cambiamo il mode di default in history per vedere in modo diverso l'url e non più il cancelletto
    mode:"history",
    // dentro routes avrò un array di obj routes
    routes: [
        // home
        {
            path: "/",
            component: Home,
            name: "home.index",
            // meta , info personalizzata di ogni rotta
            meta:{title:"Homepage",link:"Home"}
        },
        // pagina contatti
        {
            path:"/contacts",
            component: Contacts,
            name:"contacts.index",
            meta:{title:"Contacts",link:"Contacts"}
        },
        // pagina dettagli Posts , :post parametro dimamico
        {
            path:"/posts/:post",
            component:Show,
            name:"posts.show",
            // i link non ci serve in questa rotta
            meta:{title:"Dettagli del post"}

        },
        // rotta per errori
        // path quando non corrisponde in nessuno di quelli
        {
            path:"*",
            component:Errore,
            name:"error"
        }

    ]

});
// prima di andare in una rotta voglio che cambia il titolo
router.beforeEach((to,from,next)=>{
    document.title = to.meta.title;
    next();
})

// esport istanza per renderla pubblica e farla utilizzare da vue.js
export default router;