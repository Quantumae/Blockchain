<template>
  <div id="container">
    <a-list
      class="list-demo-action-layout"
      :bordered="true"
      :data="movies"
      :pagination-props="paginationProps"
    >
      <template #item="{ item }">
        <a-list-item class="list-demo-item" action-layout="vertical">
          <template #actions>
            <a-button @click="buyTicket(item)" :loading="loading"
              >点击跳转</a-button
            >
          </template>
          <template #extra>
            <div className="image-area">
              <img alt="arco-design" :src="item.pictureUrl" />
            </div>
          </template>
          <a-list-item-meta :description="item.description">
            <template #title>
              <div class="title" style="font-size: 20px">{{ item.title }}</div>
            </template>
            <template #description>
              <div>
                <p style="font-size: 16px">{{ item.description }}</p>
                <span v-if="item.ageLimit === 0" style="display: none">
                  年龄限制: {{ item.ageLimit }}
                </span>
                <span
                  v-else-if="item.ageLimit === 18"
                  style="font-weight: bold; color: red"
                >
                  年龄限制: {{ item.ageLimit }}
                </span>
                <span v-else>年龄限制: {{ item.ageLimit }}</span>
              </div>
            </template>
          </a-list-item-meta>
        </a-list-item>
      </template>
    </a-list>
  </div>
</template>

<script lang="ts" setup>
import { Message } from "@arco-design/web-vue";
import axios from "axios";
import { onMounted, ref, reactive, computed } from "vue";
import { generateVP } from "../utils/vc/vc";


const loading = ref(false);

interface Movie {
  id: number;
  title: string;
  description: string;
  pictureUrl: string;
  ageLimit: number;
  web :string;
}

interface nowuser{
  username: string; 
  password: string ;
  status:number;
}

const movies = ref<Movie[]>([]);
//const nowusers = ref<nowuser[]>([]);

const paginationProps = reactive({
  defaultPageSize: 5,
  total: 0,
});

// const fetchnow = async () => {
//     const res = await axios.get('http://localhost:3000/api/getnow');
//     if (res.status !== 200) return console.error("Failed to fetch records");
//     nowusers.value = res.data;
//     paginationProps.total = nowusers.value.length;
// };

// onMounted(() => {
//   fetchnow();
// });

//const nowuser = computed(() => nowusers.value[0]);

const fetchMovies = async () => {
  const res = await axios.get("http://localhost:3000/api/movies");
  if (res.status !== 200) return console.error("Failed to fetch movies");
  movies.value = res.data;

  paginationProps.total = res.data.length;
};

onMounted(() => {
  fetchMovies();
});


const buyTicket = async (item: Movie) => {
  const movieId = item.id;
  const didDocument = localStorage.getItem("did_document");
  if (!didDocument) {
    Message.error("请先到“个人信息”页面注册数字身份");
    return;
  }
  const did = JSON.parse(didDocument).id;

  let vp = undefined;
  if (item.ageLimit > 0) {
    // Message.error("未满18岁，无法购买");
    const vcListStr = localStorage.getItem("vc_list") || "[]";
    const vcList = JSON.parse(vcListStr);
    if (vcList.length === 0) {
      Message.error("该板块有年龄限制，请先获取出生证明！");
      return;
    }
    //if(nowuser.status === 0){
    //  Message.error("该板块有年龄限制！");
    //  return;       
    //}
    const vc = vcList[vcList.length - 1];
    const adultYear = new Date().getFullYear() - 18;
    vp = await generateVP(vc, `${adultYear}:1`);
  }

  Message.info("跳转中，请稍后...");
  loading.value = true;
  try {
    const res = await axios.post(
      "http://localhost:3000/api/movies/buyticket",
      { movieId, did, vp }
    );
    console.log(res);
    if (res.status === 200) {
      Message.success(res.data.message);
      window.location.href = item.web;
    } else {
      Message.error("跳转失败！" + res.data.message);
    }
  } catch (error: any) {
    console.log(error);
    Message.error(error.response.data);
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
#container {
  background-color: var(--color-bg-5);
  padding: 20px;
  height: 100%;
}
.list-demo-action-layout .image-area {
  width: 200px; /* 展示区域宽度不变 */
  height: 200px; /* 展示区域高度不变 */
  border-radius: 2px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* 修改图片的宽度和高度，使其变大 */
.list-demo-action-layout .image-area img {
  width: 100%; /* 使图片宽度充满整个展示区域 */
  height: 100%; /* 使图片高度充满整个展示区域 */
  object-fit: cover; /* 保持图片的比例，超出部分会被裁剪 */
  border-radius: 2px; /* 可选，如果你想让图片有圆角 */
}
</style>
