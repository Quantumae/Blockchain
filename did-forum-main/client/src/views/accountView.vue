<template>
  <div id="container">
    <a-space>
      <a-page-header title="已注册账户" :show-back="false" />
    </a-space>
    <a-list
      class="list-demo-action-layout"
      :data="records"
      :bordered="false"
      :pagination-props="paginationProps"
    >
      <template #item="{ item }">
        <div class="list-demo-item">
          <div>用户名: {{ item.username }}</div>
          <a-space></a-space>
          <div>状态: {{ item.status }}</div>
        </div>
      </template>
    </a-list>
  </div>
</template>

<script lang="ts" setup>
import { onMounted, ref, reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const records = ref([]); // 用于存储注册记录
const record = reactive({ username: '' }); // 用于表单输入
const paginationProps = reactive({
defaultPageSize: 10,
total: 0,
});

// 获取申请记录
const fetchAccounts = async () => {
  const res = await axios.get('http://localhost:3000/api/accounts');
  if (res.status !== 200) return console.error("Failed to fetch records");
  records.value = res.data;
  paginationProps.total = records.value.length;

};

onMounted(() => {
fetchAccounts();
});

</script>
<style scoped>
#container {
background-color: var(--color-bg-5);
padding: 20px;
height: 100%;
}
.list-demo-action-layout .list-demo-item {
padding: 20px 0;
border-bottom: 1px solid var(--color-fill-3);
}
.list-demo-action-layout .arco-list-item-action .arco-icon {
margin: 0 4px;
}
</style>