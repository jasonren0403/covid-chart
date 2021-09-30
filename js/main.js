var chartoption = {
    title: {
        text: '2020肺炎疫情数据',
        lineHeight: 40,
        height: 40,
        subtext: '数据来源:丁香园·丁香医生',
        sublink: 'https://ncov.dxy.cn/ncovh5/view/pneumonia'
    },
    dataZoom: [
        {
            id: 'dataZoomX',
            type: 'inside',
            xAxisIndex: [0],
            filterMode: 'empty'
        },
        {
            id: 'dataZoomY',
            type: 'inside',
            yAxisIndex: [0],
            filterMode: 'empty'
        }
    ],
    dataset: {
        dimensions: ['last_since', 'proved', 'uncertain', 'died', 'cured'],
        source: [
            // {last_since:xx(datetime),proved:xx(int),uncertain:xx(int),died:xx(int),cured:(int)}
        ]
    },
    tooltip: {
        trigger: 'axis'
    },
    toolbox: {
        show: true,
        orient: 'vertical',
        top: 20,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            // dataView: {
            //     readOnly: true
            // },
            restore: {},
            saveAsImage: {
                title: '保存为图片…'
            }
        }
    },
    legend: {
        type: 'scroll',
        data: ['proved', 'uncertain', 'died', 'cured'],
        left: 'right',
    },
    xAxis: {
        type: 'category',
        // boundaryGap: false,
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            type: 'line',
        },
        {
            type: 'line',
        },
        {
            type: 'line',
        },
        {
            type: 'line',
        }
    ],
    animationEasing: 'quarticOut',
};