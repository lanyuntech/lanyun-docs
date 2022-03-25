---
title: "异步灾备基本操作"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍同步灾备管理的基本操作。
draft: false
weight: 1
keyword: 灾备管理 , 同步灾备
---

## 创建灾备组

1. 登录管理控制台。

2. 选择 **产品与服务** > **运维与管理** > **灾备管理**，进入 **灾备管理** 页面。

   ![](/operation/disaster_recovery/_images/basic_use_1.png)

3. 点击 **开始创建灾备组**，进入 **创建灾备组** 页面：

   ![](/operation/disaster_recovery/_images/basic_use_asynchronous_1.png)

4. 配置灾备组基本信息，配置完成后，点击 **下一步**。相关参数说明如下：

   - 灾备组名称：填写灾备组的名称。
   - 选择生产中心：生产中心为产生数据和对外提供业务的主要中心。根据实际情况进行配置。
   - 选择灾备中心：灾备中心为用于备份数据、保障数据安全和业务连续性的中心。根据实际情况进行配置。

5. 选择需受灾备保护的资源，然后点击 **>** 按钮：

   ![](/operation/disaster_recovery/_images/basic_use_asynchronous_2.png)

   > **说明：**
   >
   > 受保护资源包括计算资源，网络资源（VPC网络和负载均衡器），存储资源（共享存储和文件存储）。

6. 点击灾备中心资源后的 **修改**，可修改配置，提交后，点击 **下一步**：

   ![](/operation/disaster_recovery/_images/basic_use_asynchronous_3.png)

   - 可配置生产中心出现故障时，灾备中心重新拉起云服务器时的规格。 
   - RPO：数据恢复点目标，指应用发生故障时预期的数据丢失量。根据实际情况进行配置，最低配置为5。
   - 备区副本数量：根据实际情况进行配置，可配置为1，2，3。

7. 进入 **预检查** 页面，如下所示。当检查项结果均为 **通过** 时，会自动创建灾备组，点击 **完成创建**。

   ![](/operation/disaster_recovery/_images/basic_use_4.png)

   > **说明：**
   >
   > - 受保护资源所依赖的其他资源需同时加入该灾备组。
   > - 若预检查未通过，可查看失败原因，修改后重试。

7. 页面跳转至 **灾备管理** 页面，可查看创建的灾备组。

   ![](/operation/disaster_recovery/_images/basic_use_5.png)

## 修改灾备组

1. 进入 **灾备管理** 页面，点击如图所示位置，选择 **修改** ：

   ![](/operation/disaster_recovery/_images/basic_use_6.png)

2. 弹出 **修改属性** 对话框，可修改灾备组的名称，修改完成后，点击 **确认修改**：

   ![](/operation/disaster_recovery/_images/basic_use_7.png)

## 删除灾备组

1. 进入 **灾备管理** 页面，点击如图所示位置，选择 **删除** ：

   ![](/operation/disaster_recovery/_images/basic_use_8.png)

2. 弹出 **删除灾备组** 对话框，根据页面提示输入”删除“后，点击 **确认删除**，即可删除当前灾备组：

   ![](/operation/disaster_recovery/_images/basic_use_9.png)
