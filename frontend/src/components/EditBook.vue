<template>
    <div class="editContainer pa-6">
        <div class="backbtn">
        <v-btn variant="text" color="primary" to="/"> go back</v-btn>
        </div>
        <h1 class="pb-6 text-center">Edit Book</h1>
    
      <form @submit.prevent="submit">
      <v-text-field
        v-model="title"
        label="Title"
        required
      />
  
      <v-text-field
        v-model="author"
        label="Author"
        :error-messages="authorError"
        required
      />
  
      <v-text-field
        v-model="pub_year"
        label="Pushlished Year"
        :error-messages="yearError"
        required
        />

        <v-text-field
        v-model="description"
        label="Description"
        />

    <div class="btns">
      <v-btn
        class="me-4"
        type="submit"
        color="primary"
      >
        submit
      </v-btn>
  
      <v-btn @click="handleReset" color="red-darken-2"
      variant="outlined">
        clear
      </v-btn>
    </div>
    </form>
    
    </div>
</template>

<script>
export default {
  data() {
    return {
      id: null, // Initialize id as null
      title: '',
      author: '',
      pub_year: '',
      description: '',
      book: [],
      yearError: '',
      authorError: ''
    };
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
    validate() {
      let isValid = true;

      // Custom validation for year
      if (isNaN(this.pub_year) || this.pub_year < 0) {
        this.yearError = 'Invalid year';
        isValid = false;
      } else {
        this.yearError = '';
      }

      // Custom validation for author
      if (/\d/.test(this.author)) {
        this.authorError = 'Author name cannot contain numbers';
        isValid = false;
      } else {
        this.authorError = '';
      }
      return isValid;
    },
    submit() {
      if (this.validate()) {
        const formData = {
          title: this.title,
          author: this.author,
          pub_year: this.pub_year,
          description: this.description
        };

        fetch('http://localhost:8000/api/book/' + this.id, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Failed to update book');
            }

            this.$router.push('/');
          })
          .catch(error => {
            console.log('Error: ', error.message);
            this.inputError = 'Failed to update Book';
          });
      }
    },
    handleReset() {
      this.title = '';
      this.author = '';
      this.pub_year = '';
      this.description = '';
    }
  }
};
</script>

    
<style>
    .editContainer {
        padding: 20px;
        max-width: 500px;
        margin: 0 auto;
        margin-top: 50px;
        border: 1px solid #aaaaaa;
        border-radius: 10px;
      }
      
      .form {
        width: 100%;
      }
    
      .v-text-field{
        margin-bottom: 15px;
      }
      .editContainer .btns{
        display: flex;
        justify-content: center; 
      }
      .backbtn {
        text-align: right;
      }
    
    </style>