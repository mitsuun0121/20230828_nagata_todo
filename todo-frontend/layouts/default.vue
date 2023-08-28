<template>
  <div>
    <Header />
    <nuxt />
    
  </div>
</template>

<script>
import Header from '~/components/header.vue'; // headerをインポート

export default {
  components: {
    Header,
    
  }
};
</script>

<style>
.create-message, .search-message {
  font-size: 18px;
  color: #000;
}

.delete-message {
  font-size: 18px;
  color: #ff0000;
  
}

.update-message {
  font-size: 18px;
  color: #0000ff;
}

.error-message {
  font-size: 14px;
  color: #ff0000;
}

.message {
  margin: 0 auto;
  height: 30px;
  margin-top: -15px;
  width: 70%;
}

.content {
  margin-bottom: -120px;
  padding: 60px 15px;
  max-width: 1230px;
}

.title {
  margin: 0 auto;
  margin-bottom: -15px;
  width: 70%;
}

.search-title {
  margin: 0 auto;
  margin-bottom: -15px;
  width: 70%;
}

.form {
  display: flex;
  justify-content: space-between;
  margin: 0 auto;
  width: 70%;
  text-align: center;
  margin-bottom: 20px;
}

.form__content {
  display: flex;
  width: 70%;
}

.form__text-input {
  margin-right: 10px;
  padding: 10px;
  width: 70%;
  height: 18px;
  border: 1px solid #ddd;
  border-radius: 3px;
}

.form__category-select {
  padding: 10px;
  width: 30%;
  height: 40px;
  border: 1px solid #ddd;
  border-radius: 3px;
}

.form__button {
  width: 20%;
}

.form__button-submit {
  padding: 10px;
  width: 100%;
  height: 40px;
  border: none;
  border-radius: 3px;
  background: #000;
  color: #fff;
  cursor: pointer;
  transition: 0.3s;
}

.form__button-submit:hover {
  opacity: 0.8;
  color: #ddd;
}

.form__button-submit:disabled {
  background-color: lightgray;
  color: #fff;
  cursor: not-allowed;
}

.todo__header {
  margin: 0 auto;
  width: 70%;
  font-weight: bold;
  margin-top: 40px;
  border-bottom: 1px solid #ddd;
  padding-bottom: 5px;
}

.todo__header-span-c {
  margin-left: 260px;
}

.update__todo-list {
  display: flex;
  justify-content: space-between;
  position: relative;
  right: 21px;
  margin: 0 auto;
  width: 74%;
  border-bottom: 1px solid #ddd;
  padding-bottom: 15px;
}

.create__category-list {
  display: flex;
  justify-content: space-between;
  position: relative;
  right: 21px;
  margin: 0 auto;
  width: 74%;
  border-bottom: 1px solid #ddd;
  padding-bottom: 15px;
}

.update__todo {
  position: relative;
  left: 10px;
  width: 60%;
  max-width: 300px;
  min-width: 300px;
  border: none;
  margin-top: 15px;
}

.update__category {
  display: block;
  display: flex;
  align-items: center;
  position: relative;
  left: 10px;
  width: 380px;
  margin-top: 15px;
  font-size: 13px;
}

.create__category {
  position: relative;
  left: 10px;
  width: 50%;
  border: none;
  margin-top: 15px;
}

.todo__button {
  text-align: center;
  width: 300px;
}

.categoy__button {
  width: 20%;
  text-align: center;
}

.update__button-submit {
  margin-right: 5px;
  padding: 5px;
  margin-top: 10px;
  min-width: 40px;
  border: none;
  border-radius: 3px;
  background: #0000ff;
  color: #fff;
  cursor: pointer;
  transition: 0.3s;
}

.update__button-submit:hover {
  opacity: 0.8;
}

.delete__button-submit {
  margin-right: 5px;
  padding: 5px;
  margin-top: 10px;
  min-width: 40px;
  border: none;
  border-radius: 3px;
  background: #ff0000;
  color: #fff;
  cursor: pointer;
  transition: 0.3s;
}

.delete__button-submit:hover {
  opacity: 0.8;
}
</style>
