---
title: "查看灾备组详情"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍灾备组详情的基本操作。
draft: false
weight: 2
keyword: 灾备管理
---

灾备组详情页面 ，可查看灾备组基本属性、灾备组拓扑、受保护资源以及操作日志。

## 配置策略

通过配置策略可对资源进行优先级排序，确保重要的资源优先拉起。

主备演练、切换、回切均使用该配置策略进行启动。

**操作步骤：**

1.  进入灾备组详情页面，点击如图所示位置，可进行策略配置：

   ![](/operation/disaster_recovery/_images/view_details_1.png)

2. 进入 **配置资源启动顺序** 页面，配置完成后点击 **保存顺序**：

   ![](/operation/disaster_recovery/_images/view_details_2.png)

   - 受保护资源启动方式：可选择手动启动和自动启动。为保证业务内资源启动无误，建议选择手动启动方式。

     手动启动：演练/切换/回切过程中用户按自身业务状态可以实时启停各项资源，增加业务；
     自动启动：稳健有序的一键式演练/切换/回切，无需人工干预，自动完成所有操作流程。

   - 资源启动顺序：根据实际情况，拖动资源以调整优先级排序。

## 灾备组拓扑

资源拓扑图通过可视化的方式展示了该灾备组内所有资源以及当前状态，可以在同步或者切换过程中对资源状态随时进行查看。

**操作步骤：**

1. 进入 **灾备管理** 页面，点击待查看灾备组，进入灾备组详情页面 ，选择 **灾备组拓扑** 页签：

   ![](/operation/disaster_recovery/_images/view_details_3.png)

2. 点击 **进入资源拓扑**，可选择 **业务资源** 或 **演练资源**：

   ![](/operation/disaster_recovery/_images/view_details_4.png)

3. 进入 **资源启动拓扑** 页面，对资源进行查看或操作：

   ![](/operation/disaster_recovery/_images/view_details_5.png)

   > **说明：**
   >
   > 资源启动方式配置为手动启动时，可点击 **全部启动** 按钮启动全部资源，也可双击资源对其进行启动或关闭。

## 受保护资源

### 查看资源

1. 进入灾备组详情页面，点击 **受保护资源** 页签，可查看受保护资源：

   ![](/operation/disaster_recovery/_images/view_details_6.png)

2. 点击资源类型，可选择查看不同分类的资源：

   ![](/operation/disaster_recovery/_images/view_details_7.png)

3. 点击如图所示位置，可切换查看生产中心和灾备中心资源：

   ![](/operation/disaster_recovery/_images/view_details_8.png)

### 添加资源

1. 进入灾备组详情页面，点击 **受保护资源** 页签，点击 **添加资源**：

   ![](/operation/disaster_recovery/_images/view_details_9.png)

2. 弹出选择资源提示框，选择资源后，点击灾备中心资源后的 **修改**，可修改配置，配置完成后点击 **提交**：

   ![](/operation/disaster_recovery/_images/view_details_10.png)

3. 点击 **添加**：

   ![](/operation/disaster_recovery/_images/view_details_11.png)

4. 可看到添加的资源显示在列：

   ![](/operation/disaster_recovery/_images/view_details_12.png)

### 移除资源

1. 选择待操作资源，点击 **更多操作** > **移除**，或右键选择 **移除**，可移除该资源：

   ![](/operation/disaster_recovery/_images/view_details_13.png)

2. 弹出 **移除资源** 对话框，点击 **确认删除**：

   ![](/operation/disaster_recovery/_images/view_details_14.png)

## 操作日志

1. 进入灾备组详情页面，点击 **操作日志** 页签，可查看灾备组的详细操作日志：

   ![](/operation/disaster_recovery/_images/view_details_15.png)

2. 可通过 **操作行为**、**状态** 以及 **时间** 进行筛选查看：

   ![](/operation/disaster_recovery/_images/view_details_16.png)
