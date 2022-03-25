---
title: "主备演练"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍主备演练的基本操作。
draft: false
weight: 3
keyword: 主备演练, 灾备管理
---

通过主备演练可检查数据中心的数据是否正常，确保灾备组可正常使用。

当前仅在独立 zone 架构下，支持主备演练功能。

**操作步骤：**

1. 进入灾备组详情页面，点击 **主备演练**，进入主备演练页面，配置完成后点击 **确定演练**。

   ![](/operation/disaster_recovery/_images/drill_1.png)

   参数说明如下：
   
   - 演练名称：配置主备演练的名称。

   - 资源启动方式：可在配置策略时修改，详情请参见[配置策略](/operation/disaster_recovery/asynchronous/operation/view_details#配置策略)。

2. 返回灾备组详情页面，状态变为 **演练中**：

   ![](/operation/disaster_recovery/_images/drill_2.png)

3. 当前资源启动方式为手动启动，根据页面提示，点击 **启动资源**，进入资源拓扑图，点击 **全部启动**刷新页面，待资源启动后，点击 **完成启动**。

   ![](/operation/disaster_recovery/_images/drill_3.png)

   > **说明：**
   >
   > 若资源启动方式为自动启动，系统会自动按照预先配置的资源启动顺序依次启动资源保证备区业务运行。

4. 演练完成后，点击页面上 **结束演练**：

   ![](/operation/disaster_recovery/_images/drill_4.png)

5. 弹出提示框，输入 **确定**，点击 **结束演练**：

   ![](/operation/disaster_recovery/_images/drill_5.png)

6. 返回灾备组详情页面，可查看到演练结束，状态变为 **正常保护**：

   ![](/operation/disaster_recovery/_images/drill_6.png)
