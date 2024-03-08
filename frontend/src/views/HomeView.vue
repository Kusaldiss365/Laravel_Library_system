<template>
  <div>
    <v-text-field
      v-model="search"
      label="Search here"
      hide-details
      clearable
      class="pa-6"
    ></v-text-field>

    <div class="container pa-6">
      <v-row>
        <v-col
          v-for="book in filteredBooks"
          :key="book.id"
          cols="12"
          sm="6"
          md="4"
          lg="3"
          xl="3"
        >
          <v-card
            color="blue-darken-3"
            variant="tonal"
            class="mx-auto mb-4"
            style="border-radius: 10px;"
          >
            <v-card-book>
              <div class="bookCard">
                <div class="text-h5 mb-1 pb-3 text-center">
                  <strong>{{ book.title }}</strong>
                </div>
                <div class="content">
                  <div class="text-caption-xs pb-3"><b>Author:</b> {{ book.author }}</div>
                  <div class="text-caption-xs pb-3"><b>Published in:</b> {{ book.pub_year }}</div>
                  <div class="text-caption-sm pb-3"><b>Description:</b> {{ book.description }}</div>
                </div>
              </div>
            </v-card-book>

            <div class="btns justify-end">
              <v-card-actions>
                <v-btn :to="{ name: 'viewBook', params: { id: book.id}}">View</v-btn>
              </v-card-actions>
              <v-card-actions>
                <v-btn :to="{ name: 'editBook', params: { id: book.id} }">Edit</v-btn>
              </v-card-actions>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  data() {
    return {
      drawer: null,
      search: '',
      books: [],
    }
  },
  computed: {
    filteredBooks() {
  return this.books.filter(book =>
    (book.title?.toLowerCase().includes(this.search.toLowerCase()) ||
    book.author?.toLowerCase().includes(this.search.toLowerCase()) ||
    book.published?.toLowerCase().includes(this.search.toLowerCase()) ||
    book.description?.toLowerCase().includes(this.search.toLowerCase()))
  );
  }
  },

  mounted() {
  fetch('http://localhost:8000/api/book', {
    method: 'GET'
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Failed to load books');
    }
    return response.json(); // Parse the JSON response
  })
  .then(data => {
    this.books = data; // Assign the parsed data to the books array
    console.log('Fetched books:', this.books); // Log the fetched books
  })
  .catch(error => {
    console.log('Error:', error.message);
  });
},
};
</script>

<style>
.btns {
  display: flex;
  align-content: end;
}
/* 
.content {
  font-size: 1.3rem !important;
} */
.bookCard{
  padding: 15px;
}
</style>
