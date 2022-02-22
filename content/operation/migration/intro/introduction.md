---
title: "产品简介"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍服务器迁移中心的基本情况。
draft: false
weight: 1
keyword: 云计算, 迁移中心, V2V
---

服务器迁移中心，提供V2V迁移服务，可将其它虚拟化平台的云主机系统及数据完整迁移至云平台。

通过V2V 技术将原生或第三方的源系统、源平台等工具或服务，导出为云平台所支持的镜像格式，在云平台使用导入服务导入，在保证数据一致性的情况下，实现异构平台的数据在云平台以云主机的形式运行。

## 基本概念

<table border="1">
    <tr>
        <th width="150">名称</th>
        <th width="1000">描述</th>
    </tr>
    <tr>
        <td>虚拟机</td>
        <td>通过虚拟化软件模拟硬件在系统里启动运行一个新的window或Linux系统，这个新的系统称为虚拟机。</td>
    </tr>
    <tr>
        <td>镜像</td>
        <td>指虚拟机底层文件，类似硬盘的作用，通常一个虚机有一个或多个标准格式的镜像文件，常见镜像格式有vmdk，vdi，qcow2，raw等。</td>
    </tr>
    <tr>
        <td>virtio驱动</td>
        <td>一种虚拟化技术，可提高虚机效率，并且支持热拔插，windows需要安装有virtio驱动，系统才能正常识别硬件,新版本的Linux默认支持该驱动。</td>
    </tr>
    <tr>
        <td>虚拟化平台</td>
        <td>指虚拟软件，用来启动和管理虚机的软件，常见的有：云平台，OpenStack，vmware，hyperv xenserver 等。</td>
    </tr>
    <tr>
        <td>v2v</td>
        <td>virtual machine to virtual machine 的简称，指虚机跨不同虚拟化平台迁移。</td>
    </tr>
    <tr>
        <td>虚拟网卡</td>
        <td>e1000网卡，特点是兼容性好，需要关机才能切换网络，通常操作系统默认都支持；virtio网卡，特点相反，window则安装驱动，Linux通常默认支持，运行状态下也能增删网卡，效率相对高一些。</td>
    </tr>
    <tr>
        <td>虚拟磁盘</td>
        <td>hd 类型磁盘，优点是兼容好，系统默认都支持，缺点是不能超过4个数据盘，硬盘增删需要关机；vd及sd类型磁盘，优点是支持硬盘热拔插，虚机可多个数据盘，缺点是window需要安装驱动，Linux通常默认支持。</td>
    </tr>
</table>






