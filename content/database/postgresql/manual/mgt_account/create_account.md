---
title: "添加账号"
description: 本小节主要介绍如何添加 PostgreSQL 数据库账号。 
keyword: PG,用户帐号,用户账号,添加账号,创建账号
weight: 10
collapsible: false
draft: false
---



创建 PostgreSQL 集群时，可选择创建名为 `pguser` 普通用户账号。集群创建成功后，您可根据业务需要，添加**高级权限**和**普通权限**账号。

本小节主要介绍如何创建 PostgreSQL 数据库账号。

## 约束限制

- 仅支持创建一个**高级权限**账号。
- 不支持创建同名账号。
- 不支持创建 `postgis`、`postgres`、`replica`、`zbx_monitor` 、`root` 等账号。

## 前提条件

- 已获取管理控制台登录账号和密码，且已获取集群操作权限。
- 已创建 PostgreSQL 集群，且集群状态为**活跃**。

## 操作步骤

1. 登录管理控制台。
2. 选择**产品与服务** > **数据库与缓存** > **关系型数据库 PostgreSQL**，进入集群管理页面。
3. 选择目标集群，点击目标集群 ID，进入集群详情页面。
4. 点击**账号**页签，进入数据库账号列表页面。
5. 点击**添加账号**，弹出添加账号窗口。
   
   <img src="../../../_images/set_user_info.png" alt="配置账号信息" style="zoom:50%;" />

6. 配置账号信息，详细参数说明请参见[账号参数](#账号参数)。

7. 确认配置信息无误后，点击**提交**，返回账号列表页面，即可查看已添加账号。

   <img src="../../../_images/user_list.png" alt="用户账号列表" style="zoom:50%;" />

### 账号参数

|  <span style="display:inline-block;width:120px">参数</span> | <span style="display:inline-block;width:480px">说明</span>  |
|:--- |:--- |
| 角色| 默认为主实例。 |
| 数据库密码 |  输入数据库密码。<li>密码规则：长度为 8～32 位字符数；必须同时包含大写字母（A～Z)、小写字母（a～z）、数字（0～9）和特殊字符（@#%^&*_+-=）。 |
| 确认数据库密码 |  输入与**数据库密码**相同密码。 |
| 数据库用户名 |  输入数据库用户账户名。<li>不支持添加`postgis`、`postgres`、`replica`、`zbx_monitor` 、`root`账号。<li>为确保账号名唯一性，不支持添加同名账号。<li>命名规则：长度为 2～26 个字符数；只能由大写字母（A～Z)、小写字母（a～z）、数字（0～9）和特殊字符（_）组成。 |
| 用户权限 |  选择账号权限类型。<li>可选择`普通权限`或`高级权限`。|
