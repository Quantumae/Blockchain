import { RouteRecordRaw } from "vue-router";
import BasicLayout from "../layouts/BasicLayout.vue";
import { Message } from "@arco-design/web-vue";
import
{
  IconBook,
  IconBookmark,
  IconBrush,
  IconCode,
  IconEdit,
  IconFile,
  IconFontColors,
  IconHome,
  IconList,
  IconSafe,
} from "@arco-design/web-vue/es/icon";

/**
 * 关于access权限：
 *    如果任何人都可以访问，设置
 */
export const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    redirect: "/profile",
    component: BasicLayout,
    children: [
      {
        "path": "profile",
        "name": "个人信息",
        "component": () => import("../views/ProfileView.vue"),
        "meta": {
          "icon": IconEdit,
          "hideInMenu": false,
        },
      },
      {
        path: "luntan",
        name: "论坛",
        component: () => import("../views/MoviesView.vue"),
        meta: {
          icon: IconHome,
          hideInMenu: false,
        },
      },

      {
        path: "register",
        name: "注册",
        component: () => import("../views/Register.vue"),
        meta: {
          icon: IconFile,
          hideInMenu: false,
        },
      },

      {
        path: "login",
        name: "登录",
        component: () => import("../views/Login.vue"),
        meta: {
          icon: IconFile,
          hideInMenu: false,
        },
      },

      {
        path: "verify",
        name: "实名认证",
        component: () => import("../views/verifyIdentity.vue"),
        meta: {
          icon: IconSafe,
          hideInMenu: false,
        },
      },

      {
        path: "police",
        name: "公安局",
        component: () => import("../views/policeView.vue"),
        meta: {
          icon: IconFile,
          hideInMenu: false,
        },
      },
      
      {
        path: "did",
        name: "个人DID凭证",
        component: () => import("../views/DIDView.vue"),
        meta: {
          icon: IconBookmark,
          hideInMenu: true,
        },
      },

      {
        path: "applyVC",
        name: "申请出生证明",
        component: () => import("../views/VCView.vue"),
        meta: {
          icon: IconSafe,
          hideInMenu: false,
        },
      },
      {
        path: "accounts",
        name: "账户管理",
        component: () => import("../views/accountView.vue"),
        meta: {
          icon: IconHome,
          hideInMenu: false,
        },
      },
      {
        path: "manageVC",
        name: "管理VC",
        component: () => import("../views/VCManageView.vue"),
        meta: {
          icon: IconList,
          hideInMenu: true,
        },
      },

    ]
  },
  {
    path: "/exception",
    meta: {
      hideInMenu: true,
    },
    children: [
      {
        path: "403",
        component: () => import("../views/exception/NoAuth.vue"),
      },
    ],
  },
  {
    path: "/watch/:ticketId",
    name: "观看电影",
    component: () => import("../views/WatchMovieView.vue"),
    meta: {
      icon: IconBook,
      hideInMenu: true,
    },
  }
];
