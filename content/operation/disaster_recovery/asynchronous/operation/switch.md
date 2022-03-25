---
title: "主备切换"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍主备切换的基本操作。
draft: false
weight: 4
keyword: 主备切换, 灾备管理
---

进入灾备组详情页面 ，选择 **灾备组拓扑** 页签，点击 **主备切换**，可选择 **强制切换** 或 **预期切换**，根据实际情况进行选择：

![](/operation/disaster_recovery/_images/switch_1.png)

- 强制切换：利用灾备中心已同步的数据强制进行主备切换，常用于在生产中心发生灾难时恢复业务。
- 预期切换：保证生产中心数据全部同步到灾备中心后再进行切换，常用于生产中心正常时计划中的主备切换及迁移操作。

## 强制切换

1. 选择 **强制切换**，如下所示，输入 **确定** 后，点击 **确定切换**：

   ![](/operation/disaster_recovery/_images/switch_2.png)

   > **说明：**
   >
   > 强制切换可能会造成数据丢失，请谨慎操作。

2. 返回灾备组详情页面，刷新页面，根据页面提示点击 **启动备区业务**：

   ![](/operation/disaster_recovery/_images/switch_3.png)

   > **说明：**
   >
   > 若资源启动方式为自动启动，系统会自动按照预先配置的资源启动顺序依次启动资源保证备区业务运行。

3. 进入资源拓扑图，点击 **全部启动**，资源启动完成后，点击 **完成启动**：

   ![](/operation/disaster_recovery/_images/switch_4.png)

4. 返回灾备组详情页面，可查看到主备已切换：

   ![](/operation/disaster_recovery/_images/switch_5.png)

## 预期切换

1. 选择 **预期切换**，根据页面提示，点击 **停止主区业务运行**：

   ![](/operation/disaster_recovery/_images/switch_6.png)

2. 可查看到生产中心业务停止：

   ![](/operation/disaster_recovery/_images/switch_7.png)

   > **说明：**
   >
   > - 为保证业务运行，需尽快进行主备切换或重新启动主区业务。
   >
   > - 重新启动主区业务操作如下：
   >
   >   1. 点击主区下 **重新启动主区业务**，弹出如下提示框，点击 **确认重启**：
   >
   >      ![](/operation/disaster_recovery/_images/switch_8.png)
   >
   >   2. 进入 **资源启动拓扑** 页面，点击 **全部启动** 即可重新启动主区业务：
   >
   >      ![](/operation/disaster_recovery/_images/switch_9.png)

3. 点击灾备中心下 **数据同步完成，确定主备切换**，在弹出框中输入 **确定**，点击 **确定切换**：

   ![](/operation/disaster_recovery/_images/switch_10.png)

4. 主备切换完成后，点击灾备中心下 **启动备区业务**：

   ![](/operation/disaster_recovery/_images/switch_11.png)

5. 进入 **资源启动拓扑** 页面，点击 **全部启动**，启动后点击右下角 **完成启动**：

   ![](/operation/disaster_recovery/_images/switch_12.png)

6. 返回灾备组详情页面 ，可查看灾备中心业务正常运行：

   ![](/operation/disaster_recovery/_images/switch_13.png)
