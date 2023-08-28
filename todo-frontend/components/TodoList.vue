<template>
  <div>
    <div class="content">
      <ValidationObserver ref="createserver">
        <ValidationProvider v-slot="{ errors }" rules="required|max:20">
          <div class="message">
            <span v-if="createMessage" class="create-message">{{ createMessage }}</span>
            <span v-if="searchMessage" class="search-message">{{ searchMessage }}</span>
            <span v-if="updateMessage" class="update-message">{{ updateMessage }}</span>
            <span v-if="deleteMessage" class="delete-message">{{ deleteMessage }}</span>
          </div>
          <div class="title">
            <h2>新規作成</h2>
          </div>
          <form @submit.prevent="createTodo" class="form">
            <div class="form__content">
              <input v-model="createdTodo" class="form__text-input" type="text" name="Todo" @blur="resetValidation">
              <select v-model="selectedCategory" class="form__category-select" @blur="resetValidation" :disabled="newTodoEmpty">
                <option value="">カテゴリ</option>
                <option v-for="cat in category" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
              </select>
            </div>
            <div class="form__button">
              <button class="form__button-submit" type="submit" @blur="resetValidation" :disabled="newTodoEmpty || !selectedCategory">作成</button>
            </div>
          </form>
          <div class="message">
            <span class="error-message">{{ errors[0] }}</span>
          </div>
        </ValidationProvider>
      </ValidationObserver>
    </div>

    <div class="content">
      <ValidationObserver ref="searchserver">
        <ValidationProvider v-slot="{ errors }" rules="required|max:20">
          <div class="search-title">
            <h2>Todo検索</h2>
          </div>
          <form @submit.prevent="searchTodo" class="form">
            <div class="form__content">
              <input v-model="searchedTodo" class="form__text-input" type="text" name="Todo" @blur="resetValidation">
              <select v-model="searchedCategory" class="form__category-select" @blur="resetValidation" :disabled="searchTodoEmpty">
                <option value="">カテゴリ</option>
                <option v-for="cat in category" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
              </select>
            </div>
            <div class="form__button">
              <button class="form__button-submit" type="submit" @blur="resetValidation" :disabled="searchTodoEmpty || !searchedCategory">検索</button>
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
        <span class="todo__header-span-t">Todo</span>
        <span class="todo__header-span-c">カテゴリ</span>
      </div>
      <ul>
        <li class="update__todo-list" v-for="item in todo" :key="item.id">
          <input class="update__todo" v-model="item.content" />
          <span class="update__category">{{ getCategoryName(item.category_id) }}</span>
          <div class="todo__button">
            <button class="update__button-submit" @click="updateTodo(item.id)">更新</button>
            <button class="delete__button-submit" @click="deleteTodo(item.id)">削除</button>
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
      todo: [],   // Todo一覧データ
      category: [], // カテゴリ一覧データ
      createdTodo: '', // 新しいTodoの内容
      selectedCategory: '', // 選択されたカテゴリID
      createMessage: "", // Todo作成成功時のメッセージ
      updateMessage: "", // Todo更新時のメッセージ
      deleteMessage: "", // Todo削除時のメッセージ
      searchMessage: "", // Todo検索時のメッセージ
      invalid: true, //作成、検索ボタン無効
      searchedTodo: '',   // 検索するTodoの内容
      searchedCategory: '', // 検索するカテゴリID
    };
  },
  computed: {
    newTodoEmpty() {
      return this.createdTodo.trim() === '' || this.createdTodo.length > 20;
      // Todoが空白または20文字以上入力された場合はボタンは無効
    },
    searchTodoEmpty() {
      return this.searchedTodo.trim() === '' || this.searchedTodo.length > 20;
      // Todoが空白または20文字以上入力された場合はボタンは無効
    },
  },
  mounted() {
    this.fetchTodo(); // コンポーネントがマウントされた時にTodo一覧を取得
    this.fetchCategory(); // カテゴリ一覧を取得
  },
  methods: {
    resetValidation() {
      this.$refs.createserver.reset();
      this.$refs.searchserver.reset();
    },
    async fetchTodo() {
      try {
        const response = await axios.get(`http://localhost/api/v1/todo`); // Laravel APIのURL
        this.todo = response.data.data; // Todo一覧データをセット
      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
    async fetchCategory() {
      try {
        const response = await axios.get(`http://localhost/api/v1/category`);
        this.category = response.data.data; // カテゴリ一覧データをセット
      } catch (error) {
        console.error('カテゴリ取得エラー:', error);
      }
    },
    getCategoryName(categoryId) { // カテゴリIDを受け取り、該当するカテゴリ名を返す
      const category = this.category.find(cat => cat.id === categoryId);
      return category ? category.name : '';
    },
    async createTodo() {
      if (this.createdTodo) {
        try {
          const response = await axios.post(`http://localhost/api/v1/todo`, {
            content: this.createdTodo,
            category_id: this.selectedCategory,
          });
          this.createdTodo = ''; // 入力欄をクリア
          this.selectedCategory = ''; // 入力欄をクリア
          this.createMessage = '・Todoを作成しました'; // メッセージを表示
          console.log('Todoが作成されました:', response.data.data);
          this.fetchTodo(); // 新しいTodoを作成後、一覧を再取得

          // メッセージを表示後、一定時間経過後に非表示にする
          setTimeout(() => {
            this.createMessage = '';
          }, 1500); // 1500ミリ秒 (3秒) 後にメッセージを非表示にする

        } catch (error) {
          console.error('API通信エラー:', error);
        }
      }
    },
    async updateTodo(id) {
      try {
        const item = this.todo.find(item => item.id === id); // 特定のアイテムを取得
        const response = await axios.put(`http://localhost/api/v1/todo/${id}/`, {
          content: item.content,
        });
        
        this.updateMessage = '・Todoが更新されました'; // メッセージを表示
        console.log('Todoが更新されました:', response.data.data);
        this.fetchTodo(); // 一覧を再取得

        // メッセージを表示後、一定時間経過後に非表示にする
        setTimeout(() => {
          this.updateMessage = '';
        }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする

      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
    async deleteTodo(id) {
      try {
        const response = await axios.delete(`http://localhost/api/v1/todo/${id}/`);
        
        this.deleteMessage = '・Todoが削除されました'; // メッセージを表示
        console.log('Todoが削除されました:', response.data.data);
        this.fetchTodo(); // 一覧を再取得

        // メッセージを表示後、一定時間経過後に非表示にする
        setTimeout(() => {
          this.deleteMessage = '';
        }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする

      } catch (error) {
        console.error('API通信エラー:', error);
      }
    },
    async searchTodo() {
      if (this.searchedTodo) {
        try {
          const response = await axios.get(`http://localhost/api/v1/todo`, {
            params: {
              content: this.searchedTodo,
              category_id: this.searchedCategory
            }
          });
          this.searchedTodo = ''; // 入力欄をクリア
          this.searchedCategory = ''; // 入力欄をクリア
          this.searchMessage = '・Todoが検索されました'; // メッセージを表示
          console.log('Todoが検索されました:', response.data.data);
          this.todo = response.data.data;

          // メッセージを表示後、一定時間経過後に非表示にする
          setTimeout(() => {
            this.searchMessage = '';
          }, 1500); // 1500ミリ秒 (1.5秒) 後にメッセージを非表示にする

        } catch (error) {
          console.error('API通信エラー:', error);
        }
      }
    }
  },
};
</script >


