<template>
  <div>
    <h1>Contatti</h1>
    <div v-if="!modal">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Username</label
        >
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="Inserisci UserName"
          v-model="formData.name"
        />
        <span
          class="text-danger"
          v-if="formError && formError.message"
          >{{ formError.message }}</span
        >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Email address</label
        >
        <input
          type="email"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="name@example.com"
          v-model="formData.email"
        />
        <span
          class="text-danger"
          v-if="formError && formError.message"
          >{{ formError.message }}</span
        >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Message</label
        >
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"
          v-model="formData.message"
        ></textarea>
        <span
          class="text-danger"
          v-if="formError && formError.message"
          >{{ formError.message }}</span
        >
      </div>
      <div>
        <button type="submit" class="btn btn-primary" @click="formSubmit">
          Invia!
        </button>
      </div>
    </div>
    <div v-else class="alert alert-success py-5">
      <h4>Grazie per averci contattato</h4>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      // modale che si apre una volta inviato il contatto
      modal: false,
      // campi vuoti che riempiremo con v-model negli input
      // inserito dentro un obj per comodità
      formData: {
        name: "",
        email: "",
        message: "",
      },
      // variabile nulla che contiene errori
      formError: null,
    };
  },
  methods: {
    async formSubmit() {
      // metodo pot perchè stiamo inviando dati
      // come secondo argomento passo i dati da inviare e siccome è un oggetto lo posso scrivere direttamente
      // se non li avessi messi dentro un obj li dovevo iserire uno a uno
      try {
        this.formError = null;
        const result = await axios.post("/api/contacts", this.formData);
        // modale diveta true
        this.modal = true;
      } catch (er) {
        // quando ricevo errori formError diventerà un object
        // contenente errori
        // if status errore di validazione 422
        if (er.response.status === 422) {
          this.formError = er.response.data.errors;
        }
        // catturo errore di validazione richiesta
        alert("Errore richiesta" + er.response.data.message);
      }
    },
  },
};
</script>

<style>
</style>