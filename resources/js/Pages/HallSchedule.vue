<template>
  <div class="container-fluid container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Hall Schedule</h4>
            </div>
            <div class="input-group col-md-5">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Hall</label>
              </div>
              <select v-model="hallId" class="custom-select">
                <option key="0" value="0">All</option>
                <option v-for="hall in halls" :key="hall.id" :value="hall.id">{{hall.name}}</option>
              </select>
            </div>
          </div>
          <div class="card-body">
            <vue-cal 
              style="height: 580px" 
              :disable-views="['years', 'year']"
              :time-from="7 * 60"
              :time-to="18 * 60"
              :special-hours="specialHours"
              :events="events"
              @view-change="onViewChange"
              @ready="onReady"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia"
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'

const lunchHours = { from: 12.25 * 60, to: 13.25 * 60, class: 'lunch-break', label: 'Lunch Break' }

export default {
  name: 'ProgramTable',
  components: { VueCal },
  props: {
    halls: {
      default: []
    },
    bookings: {
      default: []
    }
  },
  data(router) {
    return {
      specialHours : {
        1: lunchHours,
        2: lunchHours,
        3: lunchHours,
        4: lunchHours,
        5: lunchHours,
        6: lunchHours,
        7: lunchHours,
      },
      hallId: 0,
      startDate: '',
      endDate: '',
    }
  },
  computed: {
    events () {
      return this.bookings.map((b) => {
        var desc = b.module_id ? b.module.code + ' - ' + b.module.name : ''
        return {
          start: b.date + ' ' + b.from,
          end: b.date + ' ' + b.to,
          title: b.description,
          content: desc,
          class: b.type
        }
      })
    }
  },
  methods: {
    reload() {
      var data = {
        from: this.startDate,
        to: this.endDate
      }
      if (this.hallId > 0) data.hallId = this.hallId

      Inertia.get('/hall-schedule', data, {
        only: ['bookings'],
        preserveState: true, 
        preserveScroll: true
      })
    },
    onViewChange(e) {
      this.startDate = e.startDate
      this.endDate = e.endDate
      this.reload()
    },
    onReady(e) {
      this.startDate = e.startDate
      this.endDate = e.endDate
      this.reload()
    }
  },
  watch: {
    hallId () {
      this.reload()
    }
  }
}
</script>

<style>
.lunch-break {
  background: repeating-linear-gradient(45deg, transparent, transparent 10px, #d8dee2 10px, #d8dee2 20px);/* IE 10+ */
  color: #999;
  display: flex;
  justify-content: center;
  align-items: center;
}
.vuecal__event.lecture {
  background-color: rgba(253, 156, 66, 0.9);
  border: 1px solid rgb(233, 136, 46);
  color: #fff;
}
.vuecal__event.tutorial {
  background-color: rgba(66, 116, 253, 0.9);
  border: 1px solid rgb(58, 46, 233);
  color: #fff;
}
</style>