<template>
    <article class="main-panel" v-if="loaded">
        <div class="panel">
            <div class="panel-header">
                <p>/ dashboard</p>
            </div>
            <div class="chart-row">
                <div class="chart">
                    <div class="chart-description">
                        <i class="fa-solid fa-user-tie fa-xl"></i>
                        <h3>Autorizētu lietotāju grupa</h3>
                    </div>
                    <div id="chartdiv">
                    </div>
                </div>
                <div class="chart">
                    <div class="chart-description">
                        <i class="fa-solid fa-user-tie fa-xl"></i>
                        <h3>Aktivākais moderātors</h3>
                    </div>
                    <div id="chartdiv2">
                    </div>
                </div>
            </div>
        </div>
        <div class="double-chart">
            <div class="panel">
                <div class="panel-header">
                    <i class="fa-solid fa-paragraph fa-2xl"></i>
                    <p></p>
                </div>
            </div>
            <div class="panel">
                <div class="panel-header">
                    <i class="fa-solid fa-square-poll-vertical fa-2xl"></i>
                    <p></p>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import * as am5 from '@amcharts/amcharts5';
import am5themes_Animated from '@amcharts/amcharts5/themes/Animated';
import * as am5percent from "@amcharts/amcharts5/percent";
import axios from 'axios';

export default{
    data(){
        return{
            loaded: 'false'
        }
    },
     async mounted(){
        const response = await axios.get('/api/user-list');
        const top_moderators = await axios.get('/api/top-moderators');
        
        let root = am5.Root.new("chartdiv");
        root.setThemes([
        am5themes_Animated.new(root)
        ]);

        let chart = root.container.children.push( 
        am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }) 
        );

        let moderator_count = 0
        let administrator_count = 0

        response.data.forEach(element => {
            if(element.permision == "moderator"){
                moderator_count += 1
            }else{
                administrator_count += 1
            }
        });

        let data = [
            {permision: "Moderatori", count: moderator_count},
            {permision: "Administratori", count: administrator_count},
        ]

        var series = chart.series.push(
        am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "count",
            categoryField: "permision"
        })
        );
        series.data.setAll(data);

        let mod = am5.Root.new("chartdiv2");
        mod.setThemes([
        am5themes_Animated.new(mod)
        ]);

        let chart_mod = mod.container.children.push( 
        am5percent.PieChart.new(mod, {
            layout: mod.verticalLayout
        }) 
        );

        data = []

        top_moderators.data.forEach(element => {
            data.push({name: element.name, actions: element.action_count})
        });

        console.log(data)

        let series_mod = chart_mod.series.push(
        am5percent.PieSeries.new(mod, {
            name: "Series",
            valueField: "actions",
            categoryField: "name"
        })
        );
        series_mod.data.setAll(data);

        this.loaded = true
    }
}
</script>
<style scoped>
.main-panel{
    background-color: #f7f7f7;
}
.panel{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    background-color: #ffffff;
    border-radius: 1rem;
    margin-bottom: 1rem;
    padding: 1rem;
}
#chartdiv{
    width: 100%;
    height: 100%;
}
.chart{
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    width: 50%;
    height: 15rem;
    background-color: #ff8c00;
    border-radius: 1rem;
}
.chart-description{
    display: flex;
    align-items: center;
    flex-direction: row;
    justify-content: flex-start;
    padding: 0.5rem;
    gap: 1rem;
    width: 50%;
}
.chart-row{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    gap: 0.5rem;
}
</style>