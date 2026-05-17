<template>
  <section>
    <div class="content-header">
      <h1>
        Onboarding
        <small>Her ses alle brugere, der har ansøgt om at blive vertificeret i systemet.</small>
      </h1>
    </div>

    <!-- Table Component -->
    <Table 
      ref="tableRef"
      :headers="headers" 
      :sorting="false"
      :route="route" 
      :include="include"
      :table="table"
      :move="false"
    >
      <!-- Custom column for files -->
      <template #item.files="{ item }">
        <section>
          <div v-if="item.files.length">

            <v-btn small @click="openFileDialog(item.files)">
              
              <span class="mdi mdi-file-eye"></span>
              
              <span>Vis fil<span v-if="item.files.length != 1">er</span> ({{ item.files.length }})</span>

              <span class="mdi mdi-file-multiple"></span>

            </v-btn>
  
          </div> 
          <div v-else>
            <i>Ingen filer</i>
          </div>
        </section>
      </template>

      <template #item.user="{ item }">
        <section>
          <div>{{item.user.first_name}} {{item.user.last_name}}</div>
          <div>{{item.user.email}}</div>
        </section>
      </template>

       <template #item.company="{ item }">
        <section>
          <div class="pa-2">

            <div>{{ item.company.name }}</div>

            <div v-if="item.company.vat.length">Cvr. {{ item.company.vat }}</div>


            <div v-if="item.company.address.length">

              <div>{{ item.company.address.street }}</div>
              <div>{{ item.company.address.post_code }} {{ item.company.address.city }}</div>

            </div>
            
          </div>
        </section>
      </template>

      <!-- Action buttons -->
      <template #item.actionbuttons="{ item }">
        <section>
          <div class="float-right" v-if="item.status == 'pending'">
            <v-btn color="green" @click="openAcceptDialog(item)">
              <span class="mdi mdi-check"></span> Accepter
            </v-btn>
            <v-btn color="red" @click="openDeleteDialog(item)">
              <span class="mdi mdi-close"></span> Slet
            </v-btn>
          </div>
        </section>
      </template>
    </Table>

    <!-- Accept Dialog -->
    <v-dialog v-model="acceptDialog" max-width="400px">
      <v-card>
        <v-card-title class="headline">Er du sikker på du vil acceptere?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green" text @click="acceptItem">Ja, accepter</v-btn>
          <v-btn text @click="acceptDialog = false">Annuller</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Delete Dialog -->
    <v-dialog v-model="deleteDialog" max-width="400px">
      <v-card>
        <v-card-title class="headline">Er du sikker på du vil slette?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" text @click="deleteItem">Ja, slet</v-btn>
          <v-btn text @click="deleteDialog = false">Annuller</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- File Preview Dialog -->
    <v-dialog v-model="fileDialog" max-width="800px">
      <v-card>
        <v-card-title class="headline">Filer</v-card-title>
        <v-card-text>
          <FilePreview :files="selectedFiles" />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="fileDialog = false">Luk</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </section>
</template>

<script>
import TableIndex from "@/Mixins/TableIndex";
import axios from "axios";
import route from 'ziggy-js';
import FilePreview from "@modules/Media/Resources/assets/js/Components/FilePreview.vue";

export default {
  mixins: [TableIndex],

  components: {
    FilePreview
  },

  data() {
    return {
      table: "onboardings",
      route: "onboarding.onboarding",
      headers: [
        
        { text: "Firma", value: "company" }, 
        { text: "Ansøger", value: "user" }, 
        { text: "Status", value: "status" }, 
        { text: "Vedhæftet", value: "files" }, 
        { text: "Oprettet", value: "created_at" }, 
        { text: "", value: "actionbuttons" }, 
      ],
      include: "user,company.address",

      acceptDialog: false,
      deleteDialog: false,
      fileDialog: false,
      selectedItem: null,
      selectedFiles: [],
    };
  },

  methods: {
    // Åbn accept-dialog
    openAcceptDialog(item) {
      this.selectedItem = item;
      this.acceptDialog = true;
    },

    // Åbn slet-dialog
    openDeleteDialog(item) {
      this.selectedItem = item;
      this.deleteDialog = true;
    },

    // Åbn file preview dialog
    openFileDialog(files) {
      this.selectedFiles = files;
      this.fileDialog = true;
    },

    // Accepter via route
    async acceptItem() {
      try {
        this.acceptDialog = false;
        this.selectedItem.status = "accepted";

        const url = route('api.onboarding.accept', this.selectedItem.id);
        await axios.post(url);

        this.refreshTable();
        this.$toast.success("Bruger accepteret!");
      } catch (error) {
        console.error(error.response);
        this.$toast.error("Noget gik galt ved accept.");
      }
    },

    // Slet via route
    async deleteItem() {
      try {
        this.deleteDialog = false;
        this.selectedItem.status = "rejected";

        const url = route('api.onboarding.reject', this.selectedItem.id);
        await axios.post(url);

        this.refreshTable();
        this.$toast.success("Bruger slettet!");
      } catch (error) {
        console.error(error);
        this.$toast.error("Noget gik galt ved sletning.");
      }
    },

    // Helper til at opdatere Table
    refreshTable() {
      if (this.$refs.tableRef && typeof this.$refs.tableRef.refresh === 'function') {
        this.$refs.tableRef.refresh();
      }
    }
  }
};
</script>
