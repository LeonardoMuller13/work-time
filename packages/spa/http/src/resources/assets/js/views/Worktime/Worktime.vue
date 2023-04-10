<template>
    <div style="height: 100%;max-width: 100%;">
        <div class="container">
            <div class="d-flex justify-content-center mt-5 w-100">
                <div class="text-center">
                    <div>
                        <h1>Worktime</h1>
                    </div>
                    <div class="mt-4">
                        <span><strong>Digite o período trabalhado</strong></span>
                    </div>
                    <div class="d-flex flex-wrap mt-2 my-2 justify-content-center">
                        <div class="mx-1">
                            <div>
                                <span>Data e hora de inicio: </span>
                            </div>
                            <date-picker v-model="hourStart" type="datetime" format="DD/MM/YYYY HH:mm"
                                valueType="YYYY-DD-MM HH:mm:ss" time-title-format="DD/MM/YYYY"></date-picker>
                        </div>
                        <div class="mx-1">
                            <div>
                                <span>Data e hora final: </span>
                            </div>
                            <date-picker v-model="hourEnd" type="datetime" format="DD/MM/YYYY HH:mm"
                                valueType="YYYY-MM-DD HH:mm:ss" time-title-format="DD/MM/YYYY"></date-picker>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-success ms-auto" @click="postHours()">Enviar</button>
                    </div>
                    <div v-if="error" class="mt-3 alert alert-danger">
                        <span>{{ error }}</span>
                    </div>
                    <div v-if="success" class="mt-3 alert alert-success">
                        <span>{{ success }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/pt-br'
import * as WorktimeServices from '@/services/WorktimeServices'

export default {
    name: "Worktime",
    components: { DatePicker },

    data() {
        return {
            hourStart: "",
            hourEnd: "",
            error: null,
            success: null,
        }
    },

    methods: {
        postHours() {
            var self = this;
            WorktimeServices.postHours(this.hourStart, this.hourEnd)
                .then((result) => {
                    self.error = null;
                    self.success = `Você trabalhou ${self.formatResponseHours(result.daily.hours, result.daily.minutes)} 
                    diurnas e ${self.formatResponseHours(result.nightly.hours, result.nightly.minutes)} noturnas.`;
                }).catch((err)=>{
                    self.success = null;
                    self.error = err.message;
                })
        },
        formatResponseHours(hours, minutes){
            return moment(hours + '-' + minutes, 'H-m').format('HH:mm')
        }
    }
}
</script>