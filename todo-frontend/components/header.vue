<template>
  <div>
    <header class="header">
      <div class="header__inner">
        <NuxtLink class="header__logo-todo" to="/" @click.native="reloadPage">Todo</NuxtLink>
        <NuxtLink class="header__logo-category" to="/category">カテゴリ一覧</NuxtLink>
      </div>
    </header>
  </div>
</template>

<script>
export default {
  methods: {
    reloadPage() {
      window.location.reload();
    }
  }
}
</script>

<style>
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: #000;
  padding: 10px 0;
}

.header__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-left: 30px;
  margin-right: 30px;
}

.header__logo-todo {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 18px;
}

.header__logo-todo:hover {
  opacity: 0.8;
}

.header__logo-category {
  color: #fff;
  text-decoration: none;
  font-size: 12px;
  
}

.header__logo-category:hover {
  opacity: 0.8;
}
</style>