<template>
  <div>
    <div class="content">
      <ValidationObserver ref="categoryserver">
        <ValidationProvider v-slot="{ errors }" rules="required|max:10">
          <div class="message">  
            <span v-if="createMessage" class="create-message">{{ createMessage }}</span>
            <span v-if="updateMessage" class="update-message">{{ updateMessage }}</span>
            <span v-if="deleteMessage" class="delete-message">{{ deleteMessage }}</span>
          </div>
          <div class="title">
            <h2>カテゴリ作成</h2>
          </div>
          <form @submit.prevent="createCategory" class="form">
            <div class="form__content">
              <input v-model="newCategory" class="form__text-input" type="text" name="カテゴリ" @blur="resetValidation">
            </div>
            <div class="form__button">
              <button class="form__button-submit" type="submit" @blur="resetValidation" :disabled="newCategoryEmpty">作成</button>
            </div>
          </form>
          <div class="message">
            <span class="error-message">{{ errors[0] }}</span>
          </div>
        </ValidationProvider>
      </ValidationObserver>
    </div>

    <div class="content">
      <div class="todo__header">
        <span class="todo__header-span">category</span>
      </div>
      <ul>
        <li class="create__category-list" v-for="item in category" :key="item.id">
        <input class="create__category" v-model="item.name" />
        <div class="categoy__button">
          <button class="update__button-submit" @click="updateCategory(item.id)">更新</button>
          <button class="delete__button-submit" @click="deleteCategory(item.id)">削除</button>
        </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      category: [],
      newCategory: "", // 新しいCategoryの内容
      createMessage: "", // カテゴリ作成成功時のメッセージ
      updateMessage: "", // カテゴリ更新時のメッセージ
      deleteMessage: "", // カテゴリ削除時のメッセージ
      invalid: true, //作成ボタン無効
    };
  },
  computed: {
    newCategoryEmpty() {
      return this.newCategory.trim() === '' || this.newCategory.length > 10;
      // カテゴリ名が空白または10文字以上入力された場合ボタンは無効
    },
  },
  mounted() {
    this.fetchCategory(); // コンポーネントがマウントされた時にcategory一覧を取得
    
  },
  methods: {
    resetValidation() {
      this.$refs.categoryserver.reset();
    },
    async fetchCategory() {
      try {
        const response = await axios.get(`http://localhost/api/v1/category`); // Laravel APIのURL
        this.category = response.data.data; // Category一覧データをセット
        
      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
    async createCategory() {
      if (this.newCategory) {
        try {
          const response = await axios.post(`http://localhost/api/v1/category`, {
            name: this.newCategory,
          });
          this.newCategory = ''; // 入力欄をクリア
          this.createMessage = '・カテゴリを作成しました'; // メッセージを表示
          console.log('Categoryが作成されました:', response.data);
          this.fetchCategory(); // 新しいCategoryを作成後、一覧を再取得

          // メッセージを表示後、一定時間経過後に非表示にする
          setTimeout(() => {
            this.createMessage = '';
          }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする
          
        } catch (error) {
          console.error('API通信エラー:', error);
        }
      }
    },
    async updateCategory(id) {
      try {
        const item = this.category.find(item => item.id === id); // 特定のアイテムを取得
        const response = await axios.put(`http://localhost/api/v1/category/${id}/`, {
          name: item.name,
        });
        
        this.updateMessage = '・カテゴリが更新されました'; // メッセージを表示
        console.log('Categoryが更新されました:', response.data);
        this.fetchCategory(); // Categoryを更新後、一覧を再取得

        // メッセージを表示後、一定時間経過後に非表示にする
        setTimeout(() => {
          this.updateMessage = '';
        }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする

      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
    async deleteCategory(id) {
      try {
        const response = await axios.delete(`http://localhost/api/v1/category/${id}/`);
        
        this.deleteMessage = '・カテゴリが削除されました'; // メッセージを表示
        console.log('Categoryが削除されました:', response.data);
        this.fetchCategory(); // Categoryを削除後、一覧を再取得

        // メッセージを表示後、一定時間経過後に非表示にする
        setTimeout(() => {
          this.deleteMessage = '';
        }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする

      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
  },
};
</script >
