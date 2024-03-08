<template>
    <div class="viewContainer">
      <v-container>
        <v-row justify="center">
          <v-col cols="auto">
  
            <v-card
              color="primary"
              variant="outlined"
              class="mx-auto"
              width="500"
              height="auto"
            >
              <v-card-item>
                <div>
                  <div class="text-h3 mb-8 text-center mt-6">
                    {{ book.title }}
                  </div>
                  <div class="text-caption-h5 mt-6"><b>Author: </b>{{ book.author }}</div>
                  <div class="text-caption-h5"><b>Published in: </b>{{ book.pub_year }}</div>
                  <div class="text-caption-h5"><b>Description: </b>{{ book.description }}</div>
                </div>
              </v-card-item>
  
              <v-card-actions>
                <div class="btns">
                  <v-btn color="red-darken-3" variant="elevated" @click="deleteBook">
                    Delete
                  </v-btn>
                  <v-btn to="/">
                    Go back
                  </v-btn>
                </div>
              </v-card-actions>
  
            </v-card>
  
          </v-col>
        </v-row>
      </v-container>
    </div>
  </template>
  
  <script>
  export default {
    data(){
        return{
            id: null,
            book: [],
        }
    },
    mounted() {
    // Update id in the mounted hook
    this.id = this.$route.params.id;

    fetch('http://localhost:8000/api/book/' + this.id, {
      method: 'GET'
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to load book');
        }
        return response.json();
      })
      .then(data => {
        this.book = data;

        this.title = this.book.title;
        this.author = this.book.author;
        this.pub_year = this.book.pub_year;
        this.description = this.book.description;

        console.log('Fetched book:', this.book);
      })
      .catch(error => {
        console.log('Error:', error.message);
      });
  },
  methods: {
    deleteBook(){
        fetch('http://localhost:8000/api/book/' + this.id, {
      method: 'DELETE'
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to Delete book');
        }
        alert('Book deleted Successfully!');
        this.$router.push('/');

        return response.json();
      }).catch(error => {
        console.log('Error:', error.message);
      })

    }
  }
}
  </script>
  
  <style scoped>
  .viewContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 60px;
  }
  .text-caption-h5 {
    margin-bottom: 15px;
    margin-left: 10px;
  }
  .viewContainer .btns {
    display: flex;
    justify-content: space-between;
    margin: 15px;
    margin-bottom: 20px;
    width: 100%;

  }
  </style>
  